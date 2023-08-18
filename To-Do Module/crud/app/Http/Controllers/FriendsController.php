<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class FriendsController extends Controller
{
    //

    public function AddFriends(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:55',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validate image file
            ]);

            $data = array();
            $data['name'] = $request->name;
            $data['address'] = $request->address;

            $image = $request->file('image');

            if ($image) {
                $image_name = date('dmy_H_s_i') . '.' . strtolower($image->getClientOriginalExtension());
                $imagePath = 'friends/' . $image_name;
                Image::make($image)->resize(100, 100)->save($imagePath);

                $data['image'] = $imagePath;

                DB::table('friends')->insert($data);

                $notification = [
                    'message' => 'Friends Added Successfully',
                    'alert-type' => 'success',
                ];

                return Redirect()->back()->with($notification);
            } else {
                DB::table('friends')->insert($data);
                $notification = [
                    'message' => 'Friends Added Without Image Successfully',
                    'alert-type' => 'success',
                ];

                return Redirect()->back()->with($notification);
            }
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return Redirect()->back()->with($notification);
        }
    }

    public function EditFriends($id)
    {
        try {
            $friends = DB::table('friends')->where('id', $id)->first();

            if (!$friends) {
                throw new \Exception('Friend not found.');
            }

            return view('edit', compact('friends'));
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect('/')->with($notification);
        }
    }

    public function UpdateFriends(Request $request, $id)
    {
        try { 
            $data = array();
            $data['name'] = $request->name;
            $data['address'] = $request->address;
            $oldImage = $request->oldImage;
            $newImage = $request->file('newImage');

            if ($newImage) {
                if ($oldImage) {
                    unlink($oldImage);
                }
                $image_name = hexdec(uniqid()) . '.' . $newImage->getClientOriginalExtension();
                $imagePath = 'friends/' . $image_name;
                Image::make($newImage)->resize(100, 100)->save($imagePath);
                $data['image'] = $imagePath;

                DB::table('friends')->where('id', $id)->update($data);
            } else {
                $data['image'] = $oldImage;
                DB::table('friends')->where('id', $id)->update($data);
            }

            $notification = [
                'message' => 'Friends Update Successfully.',
                'alert-type' => 'success',
            ];

            return redirect('/')->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect('/')->with($notification);
        }
    }

    public function DeleteFriends($id)
    {
        try {
            $friends = DB::table('friends')->where('id', $id)->first();
            if (!$friends) {
                throw new \Exception('Friend not found.');
            }

            $image = $friends->image;

            if ($image && file_exists($image)) {
                unlink($image);
            }

            DB::table('friends')->where('id', $id)->delete();

            $notification = [
                'message' => 'Friends Deleted Successfully.',
                'alert-type' => 'success',
            ];

            return Redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return Redirect()->back()->with($notification);
        }
    }
}
