<h2 class="comment-listings">Comment listings</h2><hr>
<table>
    <thead>
    <tr>
        <th>Commenter</th>
        <th>Email</th>
        <th>At Picture(title)</th>
        <th>Comment Delete</th>
        <th>Comment View</th>
    </tr>
    </thead>
    <tbody>
    @foreach($comments as $comment)
    <tr>
        <td>{{{$comment->commenter}}}</td>
        <td>{{{$comment->email}}}</td>
        <td>{{HTML::linkRoute('picture.show',$comment->picture->title,$comment->picture->id)}}</td>
        <td>{{HTML::linkRoute('comment.delete','Delete',$comment->id)}}</td>
        <td>{{HTML::linkRoute('comment.show','Quick View',$comment->id,['data-reveal-id'=>'comment-show',
        	'data-animation' => 'fadeAndPop', 'data-animationspeed' => '300', 'data-reveal-ajax'=>'true'])}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
{{$comments->links()}}
