<?php

class PictureController extends BaseController
{

    /* get functions */
    public function listPicture()
    {
        $pictures = Picture::orderBy('id', 'desc')->paginate(10);
        $this->layout->title = 'Picture listings';
        $this->layout->main = View::make('dash')->nest('content', 'pictures.list', compact('pictures'));
    }

    public function showPicture(Picture $picture)
    {
        $comments = $picture->comments()->get();
        $this->layout->title = $picture->title;
        $this->layout->main = View::make('home')->nest('content', 'pictures.single', compact('picture', 'comments'));
    }

    public function newPicture()
    {
        $this->layout->title = 'New Picture';
        $this->layout->main = View::make('dash')->nest('content', 'pictures.new');
    }

    public function editPicture(Picture $picture)
    {
        $this->layout->title = 'Edit Picture';
        $this->layout->main = View::make('dash')->nest('content', 'pictures.edit', compact('picture'));
    }

    public function deletePicture(Picture $picture)
    {
        $picture->delete();
        return Redirect::route('picture.list')->with('success', 'Picture is deleted!');
    }

    /* picture functions */
    public function savePicture()
    {
    	$pre = "images/".date("YmdHis",time());
        $picture = [
            'title' => Input::get('title'),
            'description' => Input::get('description'),
            'image' => $_FILES['picture']['name'],
        ];
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => array('regex:/^[^&%]*\\.(jpg|gif|jpeg|png|bmp)$/u'),
        ];
        $messages = array(
        	'regex' => 'Please check there is no & and % character in the file path and is an image file!!'	
        );
        $valid = Validator::make($picture, $rules, $messages);
        if ($valid->passes()) {
        	$file_path = $_FILES['picture']['tmp_name'];
        	$image_path = "F:/mxampp/htdocs/piclist/public/".$pre.'/'.$_FILES['picture']['name'];
        	mkdir("F:/mxampp/htdocs/piclist/public/".$pre);
        	if (!move_uploaded_file($file_path, $image_path)){
        		return Redirect::to('admin/dash-board')->with('failure', 'wooops!!! failed on saving~');
        		//return Redirect::to('admin/dash_board')->with('failure', 'not valid picture');
        	} else{
        		$picture['image'] = $pre.'/'.$_FILES['picture']['name'];
            	$picture = new Picture($picture);
           	 	$picture->comment_count = 0;
            	$picture->save();
            	return Redirect::to('admin/dash-board')->with('success', 'Picture is saved!');
        	}
        } else
            return Redirect::back()->withErrors($valid)->withInput();
    }

    public function updatePicture(Picture $picture)
    {
        $data = [
            'title' => Input::get('title'),
            'description' => Input::get('description'),
        ];
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        $valid = Validator::make($data, $rules);
        if ($valid->passes()) {
            $picture->title = $data['title'];
            $picture->description = $data['description'];
            if (count($picture->getDirty()) > 0) /* avoiding resubmission of same content */ {
                $picture->save();
                return Redirect::back()->with('success', 'Picture is updated!');
            } else
                return Redirect::back()->with('success', 'Nothing to update!');
        } else
            return Redirect::back()->withErrors($valid)->withInput();
    }

}
