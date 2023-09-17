@extends('layouts.header')
@section('header')

<section class="section-head"  style="background-image: url('{{url($article->image)}}');">
  <div class="head-content">
    <div class="container-main text-center">
      <h2>{{$article->heading}}</h2>
    </div>
  </div>
</section>


<section class="downloads-details">
	<div style="background: none;" class="container-fluid pg">
		<div class="row">
			{!! $article->article_content !!}
		</div>
	</div>
</section>

@endsection