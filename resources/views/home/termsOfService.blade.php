@extends('layouts.app')
@section('content')

<h1>No Kids</h1>
<p>No kids. If you are a kid, leave now. Start studying and make something of your life. Go on. Close the browser and read a book. </p>
<br>
<p>Ok, now that the kids are gone, lets cover the rules</p>
<br>
<h1>TL;DR</h1>
<p>This is my website. I make the rules and you obey or get banned. Luckily there are very few rules. <strong>This is a free speech platform</strong>, but there are limits to everything.</p>
<ul>
	<li>If it is illegal, don't post it.</li>
	<li>Incitements to violence are not allowed.</li>
	<li>Copyright material that is not fair use is not allowed.</li>
</ul>
<p>Thats it. <a href={{route('chats.index')}}>Enjoy the site</a></p>
<br>
<h1>Full Terms of Service</h1>
@include('inc.fillerText')

@endsection