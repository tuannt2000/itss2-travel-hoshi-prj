<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\BlogEditRequest;
use App\Http\Requests\Admin\Blog\BlogRequest;
use App\Services\Interfaces\BlogService;
use App\Services\Interfaces\PlaceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    protected $blogService;
    protected $placeService;

    public function __construct(BlogService $blogService, PlaceService $placeService)
    {
        $this->blogService = $blogService;
        $this->placeService = $placeService;
    }

    public function index () {
        $blogs = $this->blogService->getBlogNotApproved();
        return view('admin.pages.blogs.index', compact('blogs'));
    }

    public function myblog () {
        $blogs = $this->blogService->getBlogApproved();
        return view('admin.pages.blogs.myblogs', compact('blogs'));
    }

    public function create () {
        $places = $this->placeService->all()->get();
        return view('admin.pages.blogs.create', compact('places'));
    }

    public function approve($id) {
        $blog = $this->blogService->find($id);

        if ($blog) {
            if ($blog->update(['status' => 1])) {
                return back()->with('success', 'Approve blog success');
            }
        }

        return back()->with('error', 'Approve blog failed!');
    }

    public function store(BlogRequest $request) {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $blog = $this->blogService->create([
                'user_id' => Auth::user()->id,
                'place_id' => $validated['place_id'],
                'title' => $validated['title'],
                'content' => $validated['content'],
                'season' => $validated['season'],
                'price' => $validated['price'],
                'total_votes' => 0,
                'status' => 1
            ]);

            if ($files = $request->file('file_path')) {
                foreach($files as $file){
                    $file_path = $file->store('public/images/' . Str::slug($validated['title']));

                    $blog->blogImages()->create([
                        'file_path' => explode("public/", $file_path)[1]
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.blog')->with('success', 'Create new blog success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }

        return back()->with('error', 'Create new blog failed!');
    }

    public function update ($id) {
        $places = $this->placeService->all()->get();
        $blog = $this->blogService->find($id);
        return view('admin.pages.blogs.update', compact('blog', 'places'));
    }

    public function edit(BlogEditRequest $request, $id) {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $blog = $this->blogService->find($id);
            $this->blogService->update($blog, [
                'title' => $validated['title'],
                'content' => $validated['content'],
                'season' => $validated['season'],
                'price' => $validated['price'],
                'total_votes' => 0,
            ]);

            if ($files = $request->file('file_path')) {
                $blog->blogImages()->delete();
                foreach($files as $file){
                    $file_path = $file->store('public/images/' . Str::slug($validated['title']));

                    $blog->blogImages()->create([
                        'file_path' => explode("public/", $file_path)[1]
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.blog')->with('success', 'Update blog success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }

        return back()->with('error', 'Update blog failed!');
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $url = "storage/images/" . Str::slug($this->blogService->find($request->id)->title);
            $file_path = public_path($url);
            File::deleteDirectory($file_path);
            $this->blogService->delete($request->id);

            DB::commit();
            return redirect()->route('admin.blog')->with('success', 'Delete success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }

        return back()->with('error', 'Delete failed!');
    }
}
