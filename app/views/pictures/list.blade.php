<h2 class="picture-listings">Picture listings</h2><hr>
{{$pictures->links()}}
<table>
    <thead>
    <tr>
        <th width="300">Picture</th>
        <th width="300">Content</th>
        <th width="120">Operations</th>
    </tr>
    </thead>
    <tbody>
        @foreach($pictures as $picture)
            <tr>
                <td width ="300">
               		{{HTML::image($picture['image'],$picture['image'],array('onmouseover' => "
               			this.style.border = 'thick solid #0000FF';
               		",'onmouseout' => "
               			this.style.border = '0';
               		"))}}
                </td>
                <td width ="300" class="picture-description">
                	<p>
                		title:<b>{{' '.$picture['title']}}</b>
                	</p>
                	<div>
                		description:
                		@if(strlen($picture['description'])<120)
                		<h4 style="text-indent: 1em">
                		{{$picture['description']; }}
                		</h4>
                		@else
                		<h4 class="short-descriptiong">
                		{{substr($picture['description'], 0, 120);}}
                		</h4>
                		<h5 onclick="" class="more">
                			More...
                		</h5>
                		
                		@endif
                	</div>
                	
                </td>
                <td>
                	<p>
                		{{HTML::linkRoute('picture.edit','Edit',$picture->id)}}
                	</p>
                	<p>
                		{{HTML::linkRoute('picture.delete','Delete',$picture->id)}}
                	</p>
                	<p>
                		{{HTML::linkRoute('picture.show','View',$picture->id,['target'=>'_blank'])}}
                	</p>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$pictures->links()}}
