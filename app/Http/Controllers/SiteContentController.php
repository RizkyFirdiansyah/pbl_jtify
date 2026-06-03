<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteContentController extends Controller
{
  public function index(): JsonResponse
  {
    return response()->json([
      'success' => true,
      'data' => [
        'pages' => $this->pagesPayload(),
        'settings' => $this->settingsPayload(),
      ],
    ]);
  }

  public function pages(): JsonResponse
  {
    return response()->json([
      'success' => true,
      'data' => $this->pagesPayload(),
    ]);
  }

  public function showPage(string $slug): JsonResponse
  {
    $page = Page::query()
      ->where('slug', $slug)
      ->where('is_active', true)
      ->with(['contents' => function ($query) {
        $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
      }])
      ->first();

    if (! $page) {
      return response()->json([
        'success' => false,
        'message' => 'Page not found',
      ], 404);
    }

    return response()->json([
      'success' => true,
      'data' => $this->formatPage($page),
    ]);
  }

  public function settings(): JsonResponse
  {
    return response()->json([
      'success' => true,
      'data' => $this->settingsPayload(),
    ]);
  }

  public function showSetting(string $key): JsonResponse
  {
    $setting = Setting::query()->where('key_name', $key)->first();

    if (! $setting) {
      return response()->json([
        'success' => false,
        'message' => 'Setting not found',
      ], 404);
    }

    return response()->json([
      'success' => true,
      'data' => $this->formatSetting($setting),
    ]);
  }

  private function pagesPayload(): array
  {
    return Page::query()
      ->where('is_active', true)
      ->with(['contents' => function ($query) {
        $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
      }])
      ->orderBy('name')
      ->get()
      ->map(fn(Page $page) => $this->formatPage($page))
      ->all();
  }

  private function settingsPayload(): array
  {
    return Setting::query()
      ->orderBy('key_name')
      ->get()
      ->map(fn(Setting $setting) => $this->formatSetting($setting))
      ->all();
  }

  private function formatPage(Page $page): array
  {
    return [
      'id' => $page->id,
      'name' => $page->name,
      'slug' => $page->slug,
      'description' => $page->description,
      'is_active' => $page->is_active,
      'contents' => $page->contents->map(function ($content) {
        return [
          'id' => $content->id,
          'content_key' => $content->content_key,
          'content_type' => $content->content_type,
          'content_value' => $content->content_value,
          'resolved_value' => $this->resolveValue($content->content_type, $content->content_value),
          'sort_order' => $content->sort_order,
          'is_active' => $content->is_active,
        ];
      })->all(),
    ];
  }

  private function formatSetting(Setting $setting): array
  {
    return [
      'id' => $setting->id,
      'key_name' => $setting->key_name,
      'value' => $setting->value,
      'resolved_value' => $this->resolveValue($setting->data_type, $setting->value),
      'data_type' => $setting->data_type,
      'description' => $setting->description,
    ];
  }

  private function resolveValue(?string $type, mixed $value): mixed
  {
    if ($value === null) {
      return null;
    }

    if (in_array($type, ['image', 'file'], true) && is_string($value)) {
      return Storage::url($value);
    }

    if ($type === 'boolean') {
      return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    if ($type === 'number' && is_numeric($value)) {
      return $value + 0;
    }

    if ($type === 'json') {
      $decoded = json_decode((string) $value, true);

      return json_last_error() === JSON_ERROR_NONE ? $decoded : $value;
    }

    return $value;
  }
}
