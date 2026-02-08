<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('name')->get();
        
        // Group settings by category
        $groupedSettings = [
            'Landing Page' => $settings->filter(function($setting) {
                return in_array($setting->key, ['logo', 'nama_sekolah', 'tagline_sekolah', 'landing_hero', 'deskripsi_hero', 'tahun_ajaran']);
            }),
            'Jadwal' => $settings->filter(function($setting) {
                return str_starts_with($setting->key, 'jadwal_');
            }),
            'Kontak' => $settings->filter(function($setting) {
                return str_starts_with($setting->key, 'kontak_');
            }),
            'Lainnya' => $settings->filter(function($setting) {
                return !in_array($setting->key, ['logo', 'nama_sekolah', 'tagline_sekolah', 'landing_hero', 'deskripsi_hero', 'tahun_ajaran']) 
                    && !str_starts_with($setting->key, 'jadwal_') 
                    && !str_starts_with($setting->key, 'kontak_');
            })
        ];
        
        return view('admin.settings.index', compact('groupedSettings', 'settings'));
    }

    public function update(Request $request)
    {
        // Get all file settings
        $fileSettings = Setting::where('type', 'file')->get();
        
        // Build validation rules for file uploads
        $rules = [];
        foreach ($fileSettings as $setting) {
            if ($request->hasFile($setting->key)) {
                $rules[$setting->key] = 'image|mimes:png,jpg,jpeg|max:2048';
            }
        }
        
        // Validate if there are file uploads
        if (!empty($rules)) {
            $request->validate($rules);
        }
        
        $data = $request->except('_token', '_method');
        
        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if (!$setting) {
                continue;
            }
            
            // Handle file uploads
            if ($setting->type === 'file' && $request->hasFile($key)) {
                $file = $request->file($key);
                
                // Delete old file if exists
                if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }
                
                // Store new file
                $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('settings', $filename, 'public');
                
                $setting->update(['value' => $path]);
            } else if ($setting->type !== 'file') {
                // Update non-file settings
                $setting->update(['value' => $value]);
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}