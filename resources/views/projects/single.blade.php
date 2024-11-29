@extends('layouts.template')

@section('styles')
    <style type="text/css">
        div iframe {
            width: 100%;
            
        }
    </style>
@endsection

@section('content')
<div class="row sticky-wrapper">
    <div class="col-lg-7 col-md-7 padding-right-30">
        <div id="titlebar" class="listing-titlebar">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <!-- <img src="{{ @$project->media->last()->link }}" height="150px" title="Project image" alt="Graphic representing {!! $project->name !!}"/> -->
                    @if(@$project->media->first())
                        <img src="{{ @$project->media->first()->link }}" loading="lazy" alt="Graphic representing {!! $project->name !!}">
                    @else
                        <img src="{{ asset('images/gray.png') }}" loading="lazy" alt="Graphic representing {!! $project->name !!}">
                    @endif

                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="listing-titlebar-title">
                        <h2>{!! $project->name !!}</h2>
                        {{-- @if(!empty($project->email))
                            <br>
                            <span>
                                <a href="#">
                                    <i class="fa fa-envelope-o"></i>
                                    {{ @$project->email }}
                                </a>
                            </span>
                        @endif --}}
                        @if(!empty($project->website_url))
                            <br>
                            <span>
                                <a href="{{ @$project->website_url }}" target="_blank">
                                    <i class="fa fa-globe"></i>
                                    {{ @$project->website_url }}
                                </a>
                            </span>
                        @endif
                        @if($project->location->count() > 0)
                            <br>
                            <span>
                                {{-- <a href="https://maps.google.com/?q={{ $project->latitude }},{{ $project->longitude }}&label={{ $project->name }}" class="popup-gmaps">
                                    <i class="fa fa-map-marker"></i>
                                    {{ @$project->location->first()->name }}
                                </a> --}}
                                <i class="fa fa-map-marker"></i>
                                {{ @$project->location->first()->name }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>

        <div id="listing-overview" class="listing-section">
            @if($project->tags->count() > 0)
                <ul class="apartment-details">
                    @foreach($project->tags as $tag)
                        <li>
                            <a href="/listing-tag/{{ @$tag->name }}">{{ @$tag->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="margin-top-35">
                <p>
                    {!! $project->introduction !!}
                </p>
                @if(!empty($project->description))
                    <p class="listing-description">
                        {{ Illuminate\Mail\Markdown::parse($project->description) }}
                    </p>
                @endif
            </div>

            <div class="margin-top-35 table-responsive">
                <table class="table table-responsive">
                    <tbody>
                        @if(!empty(@$project->organization_type))
                            <tr><th>Organization Type: </th><td>{{ $project->organization_type }}</td></tr>
                        @endif
                        @if(!empty(@$project->status))
                            <tr><th>Status: </th><td>{{ $project->status }}</td></tr>
                        @endif
                        @if($project->links->count() > 0)
                            <tr>
                                <th>Related Links: </th>
                                <td>
                                    <ul>
                                        @foreach(@$project->links as $link)
                                            <li>
                                                <a style="color: #0A78C2;" target="_blank" href="{{ $link->link }}">
                                                    {{ $link->notes }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
                        {{-- @if(!empty(@$project->email))
                            <tr><th>Email: </th><td>{{ $project->email }}</td></tr>
                        @endif --}}
                        @if(!empty(@$project->claimed_status))
                            <tr>
                                <th>Claimed Status: </th>
                                <td>
                                    {{ $project->claimed_status }}
                                    <!-- <span class="status-claimed">Claimed</span> -->
                                </td>
                            </tr>
                        @endif
                        @if(!empty(@$project->founded))
                            <tr><th>Founded: </th><td>{{ $project->founded }}</td></tr>
                        @endif
                        @if(!empty(@$project->closed))
                            <tr><th>Closed: </th><td>{{ $project->closed }}</td></tr>
                        @endif
                        @if(!empty(@$project->shutdown_reason))
                            <tr><th>If shutdown, what happened?: </th><td>{{ $project->shutdown_reason }}</td></tr>
                        @endif
                        @if(!empty(@$project->postmortem))
                            <tr><th>Postmortem: </th><td>{{ $project->postmortem }}</td></tr>
                        @endif
                        @if(!empty(@$project->parent_id))
                            <tr><th>Parent Organization: </th><td><a  style="color: #0A78C2;" href="/listing/{{ $project->parent->slug }}">{{ $project->parent->name }}</a></td></tr>
                        @endif
                        @if(@$project->children->count() > 0)
                            <tr>
                                <th>Project(s): </th>
                                <td>
                                    @foreach($project->children as $child)
                                        <a style="color: #0A78C2;" href="/listing/{{ $child->slug }}">
                                            {{ $child->name }}
                                        </a>
                                        @if($project->children->last()->id != $child->id)
                                        ,&nbsp;
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                        @if(!empty(@$project->language))
                            <tr>
                                <th>Language(s): </th>
                                <td>{{ $project->language }}
                                    @if(!empty(@$project->secondary_language))
                                        , {{ $project->secondary_language }}
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @if(!empty(@$project->open_source))
                            <tr><th>Open Source: </th><td>{{ $project->open_source }}</td></tr>
                        @endif
                        @if(!empty(@$project->open_source_license))
                            <tr><th>Open Source License: </th><td>{{ $project->open_source_license }}</td></tr>
                        @endif
                        @if(!empty(@$project->features))
                            <tr><th>Features: </th><td>{{ $project->features }}</td></tr>
                        @endif
                        @if(!empty(@$project->project_stage))
                            <tr><th>Project Stage: </th><td>{{ $project->project_stage }}</td></tr>
                        @endif
                        @if(!empty(@$project->used_by))
                            <tr><th>Who's it used by?: </th><td>{{ $project->used_by }}</td></tr>
                        @endif
                        @if(!empty(@$project->pricing_information))
                            <tr><th>Pricing information: </th><td>{{ $project->pricing_information }}</td></tr>
                        @endif
                        @if(!empty(@$project->no_of_employees))
                            <tr><th>Number of employees: </th><td>{{ $project->no_of_employees }}</td></tr>
                        @endif
                        @if(!empty(@$project->last_modified))
                            <tr>
                                <th>Last Modified: </th>
                                <td>{{  Carbon\Carbon::parse(@$project->last_modified)->format('n/j/Y') }}</td>
                            </tr>
                        @endif
                        @if(!empty(@$project->created))
                            <tr>
                                <th>Added on: </th>
                                <td>{{ Carbon\Carbon::parse(@$project->created)->format('n/j/Y') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if($project->categories->count() > 0)
                <h3 class="listing-desc-headline">Project Categories</h3>
                <ul class="listing-features" style="list-style: inherit; padding-left: 30px;">
                    @foreach($project->categories as $category)
                        <li><a  style="color: #0A78C2;" href="/listing-category/{{ $category->slug }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            @endif

            <div class="clearfix"></div>
        </div>

        <!-- Slider -->
        @if($project->media->count() > 1)
            <div id="listing-gallery" class="listing-section">
                <h3 class="listing-desc-headline margin-top-70">Additional Images</h3>
                <div class="listing-slider-small mfp-gallery-container margin-bottom-0">
                    @foreach($project->media as $fi)
                        <a href="{{ $fi->link }}" data-background-image="{{ $fi->link }}" class="item mfp-gallery" title="Featured image"></a>
                    @endforeach
                </div>
            </div>
        @endif

        @if(@$project->funding->count() > 0)
            <div id="add-review" class="add-review-box">
                <h3 class="listing-desc-headline margin-bottom-10">Funding Details</h3>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Funded By</th>
                            <th>Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project->funding as $fng)
                            <tr>
                                <td>{{ @$fng->funded_by }}</td>
                                <td>
                                    @if(!empty($fng->link))
                                        <a href="{{ @$fng->link }}" target="_blank" style="color: blue;">
                                            {{ @$fng->funding_date }}
                                        </a>    
                                    @else
                                        {{ @$fng->funding_date }}
                                    @endif
                                </td>
                                <td>
                                    @if(@$fng->amount > 0)
                                        $ {{ @$fng->amount }}
                                    @else
                                        &nbsp;
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        @endif

        @if(@$project->impact->count() > 0 && !empty(@$project->impact->first()->statement))
            <div id="add-review" class="add-review-box" style="margin-top: 10px; background-color: #fcfcfc;">
                <h3 class="listing-desc-headline margin-bottom-10">Evidence of this project's impact:"</h3>
                <p> 
                    {{ @$project->impact->first()->statement }}
                    @if(!empty(@$project->impact->first()->url))
                        (<a href="{{ @$project->impact->first()->url }}" style="color: #0A78C2;">Source</a>,
                    @endif
                    @if(!empty(@$project->impact->first()->impact_date))
                        <a href="{{ @$project->impact->first()->impact_date }}">
                            {{ @$project->impact->first()->impact_date }}
                        </a>)
                    @else
                        )
                    @endif
                </p>
            </div>
        @endif

        <div class="margin-top-50" style="max-height: 600px; overflow-y: scroll;">
            @if(!empty($project->has_iframe_embed))
                {!! $project->has_iframe_embed !!}
            @endif
        </div>
        {{-- <div class="margin-top-50" style="max-height: 600px; overflow-y: scroll;">
            @if(!empty($project->has_twitter_feed))
                {!! $project->has_twitter_feed !!}
            @endif
        </div> --}}

    </div>


    <!-- Sidebar -->
    <div class="col-lg-5 col-md-5 margin-top-50 sticky">
        @if(!empty($project->latitude) && !empty($project->longitude))
            <div id="listing-location" class="listing-section">
                <div id="singleListingMap-container">
                    <div id="singleListingMap" data-latitude="{{ @$project->latitude }}" data-longitude="{{ @$project->longitude }}" data-name="{{ $project->name }}" data-map-icon="fa fa-map-marker"></div>
                </div>
            </div>
        @endif
       
        <div class="listing-share margin-top-40 margin-bottom-40 no-border">
            @if(@$project->founders->count() > 0)
                <div class="boxed-widget" style="text-align: left;">
                    <h3>Founder(s)</h3>
                    <div class="row with-forms">
                        <ul style="padding-left: 30px;">
                            @foreach($project->founders as $founder)
                                <li><span style="color: #444;">{{ @$founder->name }}</span></li>
                                <span>&nbsp;</span>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <ul class="share-buttons margin-top-40 margin-bottom-0">
                @if(!empty($project->facebook_url))
                    <li>
                        <a class="fb-share" target="_blank" href="{{ $project->facebook_url }}"><i class="fa fa-facebook"></i> Facebook</a>
                    </li>
                @endif
                @if(!empty($project->twitter_url))
                    <li>
                        <a class="twitter-share" target="_blank" href="{{ $project->twitter_url }}"><i style="color: #1da1f2" class="fa fa-twitter"></i> Twitter</a>
                    </li>
                @endif
                @if(!empty($project->instagram_url))
                    <li>
                        <a class="instagram-share" target="_blank" href="{{ $project->instagram_url }}"><i class="fa fa-instagram"></i> Instagram</a>
                    </li>
                @endif
            </ul>

            <ul class="share-buttons margin-top-40 margin-bottom-0">
                @if(!empty(@$project->claimed_status))
                    <li>
                        <span class="status-claimed" style="color: #fff !important;">Claimed</span>
                    </li>
                @else
                    <div class="margin-top-35">
                        <a class="suggest-button button border" target="_blank" href="https://airtable.com/shrxW8FswmOECWlBE?prefill_Requested+Claim={{ $project->airtable_id }}">    Claim This Listing
                        </a>
                    </div>
                @endif
            </ul>

            @if(!empty(@$project->contact_form_email))
                <div class="boxed-widget margin-top-35" style="text-align: left;">
                    <h3>Contact {{ $project->name }}</h3>
                    <form action="/listing-contact-form" method="POST">
                        @csrf
                        <div class="row">
                            @if(Session::has('success'))
                                <div class="col-12">
                                    <div class="alert alert-success" style="padding: 10px 25px; color: #006600;">
                                        <p style="color: #006600 !important;">
                                            {{ Session('success') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="col-12" style="color: #EA0630;">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="msg" rows="4" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group mt-3 col-9">
                                @if(config('services.recaptcha.key'))
                                    <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}">
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mt-3 col-3 text-right" style="margin-top: -60px;">
                                <input type="hidden" name="recipient" id="recipient" value="{{ $project->contact_form_email }}">
                                <input type="hidden" name="slug" id="slug" value="{{ $project->slug }}">
                                <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                            </div>
                            <div class="mt-3 col-12">
                                <p style="margin-top: 30px; font-size: 12px; line-height: 20px;">
                                    By hitting "Send", you agree that the Civic Tech Field Guide will share your email address and message with {{ $project->name }}. {{ $project->name }} has agreed to receive messages via this form but may not be able to reply to every message. This service does not imply any affiliation between {{ $project->name }} and the Civic Tech Field Guide. You will not be signed up for anything.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            @if(!empty(@$project->linkedin_url) || !empty(@$project->youtube_channel) || !empty(@$project->contact_page_url) || !empty(@$project->github_url) || !empty(@$project->events_page_url) || !empty(@$project->jobs_page_url) || !empty(@$project->blog_url) || !empty(@$project->host_organization_url) || !empty(@$project->host_organization_url))
                <div class="boxed-widget opening-hours margin-top-35" style="text-align: left;">
                    <h3>Resources</h3>
                    <ul>
                        @if(!empty(@$project->linkedin_url))
                            <li>LinkedIn: <span><a href="{{ @$project->linkedin_url }}" target="_blank">{{ @$project->linkedin_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->youtube_channel))
                            <li>Youtube: <span><a href="{{ @$project->youtube_channel }}" target="_blank">{{ @$project->youtube_channel }}</a></span></li>
                        @endif
                        @if(!empty(@$project->contact_page_url))
                            <li>Contact page: <span><a href="{{ @$project->contact_page_url }}" target="_blank">{{ @$project->contact_page_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->github_url))
                            <li>Github: <span><a href="{{ @$project->github_url }}" target="_blank">{{ @$project->github_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->events_page_url))
                            <li>Events page: <span><a href="{{ @$project->events_page_url }}" target="_blank">{{ @$project->events_page_url }}</a><span></li>
                        @endif
                        @if(!empty(@$project->jobs_page_url))
                            <li>Jobs page: <span><a href="{{ @$project->jobs_page_url }}" target="_blank">{{ @$project->jobs_page_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->blog_url))
                            <li>Blog: <span><a href="{{ @$project->blog_url }}" target="_blank">{{ @$project->blog_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->tiktok_url))
                            <li>TikTok: <span><a href="{{ @$project->tiktok_url }}" target="_blank">{{ @$project->tiktok_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->slack_url))
                            <li>Slack: <span><a href="{{ @$project->slack_url }}" target="_blank">{{ @$project->slack_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->mastodon))
                            <li>Mastodon: <span><a href="{{ @$project->mastodon }}" target="_blank">{{ @$project->mastodon }}</a></span></li>
                        @endif
                        @if(!empty(@$project->threads))
                            <li>Threads: <span><a href="{{ @$project->threads }}" target="_blank">{{ @$project->threads }}</a></span></li>
                        @endif
                        @if(!empty(@$project->bluesky_url))
                            <li>BlueSky: <span><a href="{{ @$project->bluesky_url }}" target="_blank">{{ @$project->bluesky_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->rss))
                            <li>RSS: <span><a href="{{ @$project->rss }}" target="_blank">{{ @$project->rss }}</a></span></li>
                        @endif
                        @if(!empty(@$project->whatsapp_community_url))
                            <li>Whatsapp: <span><a href="{{ @$project->whatsapp_community_url }}" target="_blank">{{ @$project->whatsapp_community_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->telegram_community_url))
                            <li>Telegram: <span><a href="{{ @$project->telegram_community_url }}" target="_blank">{{ @$project->telegram_community_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->discord_url))
                            <li>Discord: <span><a href="{{ @$project->discord_url }}" target="_blank">{{ @$project->discord_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->parent_id))
                            <li>Parent Org: <span><a  style="color: #0A72B8;" href="/listing/{{ $project->parent->slug }}">{{ @$project->parent->name }}</a></span></li>
                        @endif
                        {{-- @if(!empty(@$project->host_organization_url))
                            <li>Host Org Url: <span><a href="{{ @$project->host_organization_url }}" target="_blank">{{ @$project->host_organization_url }}</a></span></li>
                        @endif --}}
                    </ul>
                </div>
            @endif

            {{-- @if($project->links->count() > 0)
                <div class="boxed-widget opening-hours margin-top-35" style="text-align: left;">
                    <h3>Links</h3>
                    <ol>
                        @foreach($project->links as $link)
                            <li>
                                <h5>Link:</h5> <span><a href="{{ @$link->link }}" target="_blank">{{ @$link->link }}</a></span>
                            </li>
                           <br/>
                            <h5>Notes:</h5> <span>{{ $link->notes }}</span>
                            
                        @endforeach
                    </ol>
                </div>
            @endif --}}

            <div class="margin-top-35">
                <a class="suggest-button" target="_blank" href="https://airtable.com/shrAPHxxye5l9CIpQ">Suggest a change</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{$gMapsApiKey}}&sensor=false"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    
    <script type="text/javascript" src="{{ asset('js/infobox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/markerclusterer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/maps.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection