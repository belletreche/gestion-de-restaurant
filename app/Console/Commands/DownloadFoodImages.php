<?php

namespace App\Console\Commands;

use App\Models\Plat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DownloadFoodImages extends Command
{
    protected $signature = 'download:food-images';
    protected $description = 'Download real food images from Unsplash for all dishes';

    public function handle()
    {
        $plats = Plat::all();

        if ($plats->isEmpty()) {
            $this->warn('No dishes found.');
            return;
        }

        Storage::disk('public')->makeDirectory('plats');

        $imageUrls = [
            'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1551024601-bec78aea704b?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?w=400&h=300&fit=crop',
        ];

        $fallbackColors = ['e74c3c', 'e67e22', '2ecc71', '9b59b6', '3498db', 'f39c12', '1abc9c', 'e74c3c', '2c3e50', 'c0392b'];

        foreach ($plats as $i => $plat) {
            $url = $imageUrls[$i % count($imageUrls)];
            $filename = 'plats/' . $plat->id . '.jpg';
            $path = Storage::disk('public')->path($filename);

            $this->info("Downloading image for: {$plat->nom}...");

            try {
                $response = Http::timeout(15)->get($url);

                if ($response->successful()) {
                    Storage::disk('public')->put($filename, $response->body());
                    $plat->update(['image' => $filename]);
                    $this->info("  ✓ Success");
                } else {
                    throw new \Exception('HTTP ' . $response->status());
                }
            } catch (\Exception $e) {
                $this->warn("  ✗ Failed to download, creating fallback: " . $e->getMessage());

                $color = $fallbackColors[$i % count($fallbackColors)];
                $img = imagecreatetruecolor(400, 300);
                $bg = sscanf($color, '%2x%2x%2x');
                $bgColor = imagecolorallocate($img, $bg[0], $bg[1], $bg[2]);
                $textColor = imagecolorallocate($img, 255, 255, 255);
                imagefill($img, 0, 0, $bgColor);

                $text = $plat->nom;
                $tw = imagefontwidth(5) * strlen($text);
                imagestring($img, 5, (400 - $tw) / 2, 130, $text, $textColor);

                $price = number_format($plat->prix, 2, ',', ' ') . ' DA';
                $pw = imagefontwidth(3) * strlen($price);
                imagestring($img, 3, (400 - $pw) / 2, 160, $price, $textColor);

                ob_start();
                imagepng($img);
                $pngData = ob_get_clean();
                imagedestroy($img);

                $pngFilename = 'plats/' . $plat->id . '.png';
                Storage::disk('public')->put($pngFilename, $pngData);
                $plat->update(['image' => $pngFilename]);
                $this->info("  ✓ Fallback created");
            }
        }

        $this->info('All dish images processed!');
    }
}
