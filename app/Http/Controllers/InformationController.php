<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InformationController extends Controller
{
    //Get daftar informasi dengan filter dan sorting 
    public function index(Request $request): JsonResponse|View
    {
        $query = Information::where('status', 'published')
            ->where('deadline', '>=', now())
            ->with(['category', 'user'])
            ->latest('created_at');

        // Filter by category
        if ($request->has('category') && $request->category !== '') {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                    ->orWhere('description', 'like', $search);
            });
        }

        // Check if API request
        if ($request->wantsJson()) {
            $informations = $query->paginate(10);
            return response()->json($informations);
        }

        // Web view
        $informations = $query->paginate(12);
        return view('informations.index', compact('informations'));
    }

    //Get detail single informasi 
    public function show(Information $information, Request $request): JsonResponse|View
    {
        if ($information->status !== 'published') {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Information not found'], 404);
            }
            abort(404);
        }

        $information->load(['category', 'user', 'recruitmentTeams']);

        if ($request->wantsJson()) {
            return response()->json($information);
        }

        return view('informations.show', compact('information'));
    }

    //Get daftar kategori untuk filter
    public function categories(): JsonResponse
    {
        $categories = Information::query()
            ->where('status', 'published')
            ->where('deadline', '>=', now())
            ->distinct('category_id')
            ->with('category')
            ->get()
            ->pluck('category')
            ->unique('id');

        return response()->json($categories);
    }
}
