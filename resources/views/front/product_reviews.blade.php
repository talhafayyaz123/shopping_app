                                   @php
                                   $avg=0;
                                   $rating_star='0%';
                                   $avg_rating=0;
                                   $total_variant_reviews=0;
                                   $total_comments=count($reviews);
                                   $percentage=0;

                                    foreach($reviews as $review){
                                
                                     $avg_rating+= $review->rating;
                                     $total_variant_reviews++;
                                
                                  }


                             if($total_comments!=0){
                            $percentage=(($avg_rating/$total_comments));
                        
                             $percentage=($percentage/$avg_rating)*100;
                             $percentage=number_format($percentage,2);    
                             $avg=number_format($avg_rating/$total_comments,2);
                               $avg=(int)$avg;



                               if($avg==1){
                                    $rating_star='20%';
                                }else if($avg==2){
                                     $rating_star='40%';
                                }else if($avg==3){
                                     $rating_star='60%';
                                }else if($avg==4){
                                     $rating_star='80%';
                                }else{
                                     $rating_star='100%';
                                }

                             }
                            
                              
                                  @endphp
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-lg-5 mb-4">
                                            <div class="ratings-wrapper">
                                                <div class="avg-rating-container">
                                                    <h4 class="avg-mark font-weight-bolder ls-50">
                                                @if($total_comments!=0)

                                                {{ number_format($avg_rating/$total_comments,2) }}
                                                @else
                                                0
                                                @endif

                                                    </h4>
                                                    <div class="avg-rating">
                                                        <p class="text-dark mb-1">Average Rating</p>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                        <span class="ratings" style="width: {{ $rating_star }};"></span>
                                                            
                                                            
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <a class="rating-reviews">({{$total_variant_reviews}} Reviews)</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="ratings-value d-flex align-items-center text-dark ls-25">
                                                        <span
                                                            class="text-dark font-weight-bold">
                                                </div>
                                                <div class="ratings-list">
                                                    <div class="ratings-container">
                                                        
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: {{ $rating_star}};"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <div class="progress-bar progress-bar-sm ">
                                                            <span style="width: {{ $rating_star}};"></span>
                                                        </div>
                                                        <div class="progress-value">
                                                            <mark>{{$rating_star}}</mark>
                                                        </div>
                                                    </div>
                                                    

                                                </div>
                                            </div>
                                        </div>
                                         
                                         @if(Auth::check())
                                        <div class="col-xl-8 col-lg-7 mb-4 customer_reviews" style="display:none;">
                                                <div class="review-form-wrapper">
                                                    <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                        Review</h3>
                                                    <p class="mb-3">Your email address will not be published. Required
                                                        fields are marked *</p>
                                                    <form action="" method="POST" class="review-form">
                                                        {{ csrf_field() }}
                                                        <div class="rating-form">
                                                            <label for="rating">Your Rating of This Product:</label>

                                                            <input id="star-rating-id" name="star_rating" class="rating"
                                                                   value="0" data-min="0" data-max="5" data-step="1"
                                                                   data-size="xs" required="">


                                                        </div>
                                                        <textarea cols="30" rows="6"
                                                                  placeholder="Write Your Review Here..."
                                                                  class="form-control"
                                                                  id="remarks" name="remarks" required></textarea>

                                                        <div class="form-group" style="display:none;">
                                                            <input type="checkbox" class="custom-checkbox"
                                                                   id="save-checkbox">
                                                            <label for="save-checkbox">Save my name, email, and website
                                                                in this browser for the next time I comment.</label>
                                                        </div>
                                                        <button type="button" onclick="saveRating()"
                                                                class="btn btn-dark">Submit
                                                            Review
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                        <ul class="nav nav-tabs" role="tablist" style="display:none;">
                                            <li class="nav-item">
                                                <a href="#show-all" class="nav-link active">Show All</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#helpful-positive" class="nav-link">Most Helpful
                                                    Positive</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#helpful-negative" class="nav-link">Most Helpful
                                                    Negative</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#highest-rating" class="nav-link">Highest Rating</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#lowest-rating" class="nav-link">Lowest Rating</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="show-all">
                                               
                                                <ul class="comments list-style-none">
                                                     @foreach($reviews as $review)
 
                                               
                                               @php

                                            if($review->rating==1){
                                                $rating_width='20%';
                                            }else if($review->rating==2){
                                                 $rating_width='40%';
                                            }else if($review->rating==3){
                                                 $rating_width='60%';
                                            }else if($review->rating==4){
                                                 $rating_width='80%';
                                            }else{
                                                 $rating_width='100%';
                                            }
                                        
                                               @endphp

                                                    <li class="comment">
                                                        <div class="comment-body">

                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a>{{ $review->customer->f_name }} {{ $review->customer->l_name }}</a>

                                                                    <span class="comment-date">{{ \Carbon\Carbon::parse($review->created_at)->format('d-M-Y')}}</span>
                                                                </h4>
                                                                <div class="ratings-container comment-rating">
                                                                    <div class="ratings-full">
                                                                            <span class="ratings"
                                                                                  style="width: {!! $rating_width !!};"></span>
                                                                        <span
                                                                            class="tooltiptext tooltip-top"></span>
                                                                    </div>
                                                                </div>
                                                                <p>{{ $review->remarks }}</p>
                                                              
                                                            </div>
                                                        </div>
                                                    </li>
                                                    
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="tab-pane" id="highest-rating">
                                                <ul class="comments list-style-none">
                                                    <li class="comment">
                                                        <div class="comment-body">

                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a href="#">John Doe</a>
                                                                    <span class="comment-date">March 22, 2021 at
                                                                            1:52 pm</span>
                                                                </h4>
                                                               
                                                                <p>Nullam a magna porttitor, dictum risus nec,
                                                                    faucibus sapien.
                                                                    Ultrices eros in cursus turpis massa tincidunt
                                                                    ante in nibh mauris cursus mattis.
                                                                    Cras ornare arcu dui vivamus arcu felis bibendum
                                                                    ut tristique.</p>
                                                                <div class="comment-action">
                                                                    <a href="#"
                                                                       class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                        <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                    </a>
                                                                    <a href="#"
                                                                       class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                        <i class="far fa-thumbs-down"></i>Unhelpful
                                                                        (0)
                                                                    </a>
                                                           
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" id="lowest-rating">
                                                <ul class="comments list-style-none">
                                                    <li class="comment">
                                                        <div class="comment-body">
{{--                                                            <figure class="comment-avatar">--}}
{{--                                                                <img src="assets/images/agents/1-100x100.png"--}}
{{--                                                                     alt="Commenter Avatar" width="90" height="90">--}}
{{--                                                            </figure>--}}
                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a href="#">John Doe</a>
                                                                    <span class="comment-date">March 22, 2021 at
                                                                            1:54 pm</span>
                                                                </h4>
                                                                <div class="ratings-container comment-rating">
                                                                    <div class="ratings-full">
                                                                            <span class="ratings"
                                                                                  style="width: 60%;"></span>
                                                                        <span
                                                                            class="tooltiptext tooltip-top"></span>
                                                                    </div>
                                                                </div>
                                                                <p>pellentesque habitant morbi tristique senectus
                                                                    et. In dictum non consectetur a erat.
                                                                    Nunc ultrices eros in cursus turpis massa
                                                                    tincidunt ante in nibh mauris cursus mattis.
                                                                    Cras ornare arcu dui vivamus arcu felis bibendum
                                                                    ut tristique.</p>
                                                                <div class="comment-action">
                                                                    <a href="#"
                                                                       class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                        <i class="far fa-thumbs-up"></i>Helpful (1)
                                                                    </a>
                                                                    <a href="#"
                                                                       class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                        <i class="far fa-thumbs-down"></i>Unhelpful
                                                                        (0)
                                                                    </a>
                                                             
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                