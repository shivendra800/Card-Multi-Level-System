<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function blog()
    {
        Session::put('page', 'blog');
        $blog = Blogs::get()->toArray();
          return view('admin.blog.blog')->with(compact('blog'));
    }

    public function Deleteblog($id)
    {
        $blog=  Blogs::where('id', $id)->first();

        //Get Banner Image Path
        $blog_image_path='front_assets/blog_images/';

        //Delete banner image from folder if it exist
        if(file_exists($blog_image_path.$blog->image)){
              unlink($blog_image_path.$blog->image);
        }
        //Delete Banner from Banner table
        Blogs::where('id', $id)->delete();
        $message = "Banner Image has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function Addblog(Request $request, $id = null)
    {
        Session::put('page', 'Blog');
        if ($id == "") {
            $title = "Add Blog";
            $blog = new Blogs();
            $message = "Blog Add Successfully!";
        } else {
            $title = "Edit blog";
            $blog = Blogs::find($id);
            $message = "blog Update Successfully!";
        }


        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
                            $rules = [

                    'image'=>   'required|mimetypes:image/jpeg,image/png,image/jpg',
                ];

                $this->validate($request, $rules);
           

            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {

                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'front_assets/blog_images/' . $imageName;
                    //Upload The Image
                    Image::make($image_tmp)->resize('600','500')->save($imagePath);
                }
            } else if (!empty($data['current_image'])) {
                $imageName = $data['current_image'];
            } else {
                $imageName = "";
            }

            $blog->blog_title = $data['blog_title'];
           $blog->description = $data['description'];
             $blog->image=$imageName;
            
            $blog->save();



            return redirect('admin/Blog')->with('success_message', $message);
        }
        //  echo "test"; die;
        return view('admin.blog.add_edit_blog')->with(compact('title', 'blog'));
    }
}
