@extends('front.default.layout')

@section('pagename')
 - {{__('Team Members')}}
@endsection

@section('meta-keywords', "$be->team_meta_keywords")
@section('meta-description', "$be->team_meta_description")

@section('content')
  <!--   breadcrumb area start   -->
  <div class="breadcrumb-area cases" style="background-image: url('{{asset('assets/front/img/' . $bs->breadcrumb)}}');background-size:cover;">
     <div class="container">
        <div class="breadcrumb-txt">
           <div class="row">
              <div class="col-xl-7 col-lg-8 col-sm-10">
                 <span>{{convertUtf8($bs->team_title)}}</span>
                 <h1>{{convertUtf8($bs->team_subtitle)}}</h1>
                 <ul class="breadcumb">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                    <li>{{__('Team Members')}}</li>
                 </ul>
              </div>
           </div>
        </div>
     </div>
     <div class="breadcrumb-area-overlay" style="background-color: #{{$be->breadcrumb_overlay_color}};opacity: {{$be->breadcrumb_overlay_opacity}};"></div>
  </div>
  <!--   breadcrumb area end    -->


  <!--   team page start   -->
  <div class="container"><br><br><br><br></div>
   <div class="container"> <span><h3>LEADERSHIP</h3><br><p align="justify">Our leadership team is made up of experienced industry – recognised and respected professional with diverse skills in various backgrounds, as well as a depth experience in delivering and achieving customer satisfaction as the maximum level. These leaders put their experience, skills, knowledge and leadership to work, helping the group develop and deliver innovative solutions to meet the needs of customers. </p></span></div>
  <div class="team-page">
    <div class="container">
      <div class="row">
        @foreach ($members as $key => $member)
          <div class="col-lg-3 col-sm-6">
            <div class="single-team-member">
               <div class="team-img-wrapper">
                  <img src="{{asset('assets/front/img/members/'.$member->image)}}" alt="" width="300" height="300">
                  <div class="social-accounts">
                     <ul class="social-account-lists">
                        @if (!empty($member->facebook))
                          <li class="single-social-account"><a href="{{$member->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if (!empty($member->twitter))
                          <li class="single-social-account"><a href="{{$member->twitter}}"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        @if (!empty($member->linkedin))
                          <li class="single-social-account"><a href="{{$member->linkedin}}"><i class="fab fa-linkedin-in"></i></a></li>
                        @endif
                        @if (!empty($member->instagram))
                          <li class="single-social-account"><a href="{{$member->instagram}}"><i class="fab fa-instagram"></i></a></li>
                        @endif
                     </ul>
                  </div>
               </div>
               <div class="member-info">
                  <h5 class="member-name">{{convertUtf8($member->name)}}</h5>
                  <small>{{convertUtf8($member->rank)}}</small>
               </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <!--   team page end   -->
@endsection
