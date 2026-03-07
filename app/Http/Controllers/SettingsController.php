<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::allGrouped();
        
        // Initialize defaults if empty
        if ($settings->isEmpty()) {
            Setting::initializeDefaults();
            $settings = Setting::allGrouped();
        }
        
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($request->settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting) {
                $type = $setting->type;
                
                // Handle boolean values
                if ($type === 'boolean') {
                    $value = $value === '1' || $value === true || $value === 'true';
                }
                
                // Handle array values
                if ($type === 'array' && is_array($value)) {
                    $value = json_encode($value);
                }
                
                $setting->update(['value' => $value]);
            }
        }

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully!');
    }

    public function logo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Delete old logo if exists
        $oldLogo = Setting::get('university_logo');
        if ($oldLogo && File::exists(public_path($oldLogo))) {
            File::delete(public_path($oldLogo));
        }

        // Store new logo
        $filename = 'logo.' . $request->logo->extension();
        $path = $request->logo->storeAs('uploads', $filename, 'public');
        
        Setting::set('university_logo', 'storage/' . $path, 'string', 'general', 'University Logo URL');

        return redirect()->route('settings.index')
            ->with('success', 'Logo updated successfully!');
    }

    public function reset()
    {
        Setting::truncate();
        Setting::initializeDefaults();
        
        return redirect()->route('settings.index')
            ->with('success', 'Settings reset to defaults!');
    }
}
