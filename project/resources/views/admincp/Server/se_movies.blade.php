@extends('master.main')

@section('content')



<div class="app-content content">




                <div class="row">                    <div class="col-lg-9 col-sm-12 col-12">


                    <style>
              .resp-container {
    position: relative;
    overflow: hidden;
 padding-top: 54%;

}

.resp-iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
} dropdown .btn:not(.btn-sm):not(.btn-lg), .dropdown .btn:not(.btn-sm):not(.btn-lg).dropdown-toggle {
    WIDTH: 100%;
             }

             .col-lg-3.col-sm-12.col-12, .col-lg-9.col-sm-12.col-12 {
    PADDING: 1PX;
}.card-body {

    padding: 0px 3px;
}
.smtext-bn-simo {
    font-size: smaller;
    font-weight: 400;
    left: 50px;
    position: absolute;
    font-size: 14px;
}
.btn-group, .btn-group-vertical {

    width: 100%;
    DISPLAY: inline-block;
}
 .play-action {
       float: left;
       width: 100%;
       padding: 10px;
       background: #38414a;
       border: 1px solid #38414a;
       DISPLAY: flex;
       }
       .action-bar-player {
       display: inline-block;

       }
       .action-bar-player-left {
    float: left;
    position: absolute;
    left: 15PX;
}.action-bar-player-right {


       float: right: ;;
    position: relative;
    right: 15PX;
       }
       i.feather.icon-chevrons-left {
    left: 20px;
    position: absolute;
}.col-lg-6.col-sm-12.col-12 {
    DISPLAY: contents;
}.play-action.row {
    margin-left: 0;
    margin-right: 0;
}.list-group-item.active, .btn-primary, .btn-warning {
    z-index: 2;
    color: #fff;
    background-color: #0058a3!important;
    border-color: #0058a3!important;
}.list-group-item-action {
  color: #ffffff!important;
    background-color: #323a46!important;
}.list-group-item-action:focus, .list-group-item-action:hover {
    z-index: 1;
    color: #ffffff!important;
    background-color: #0058a3!important;
    border-color: #0058a3!important;
}
                    </style>
        <div class="card-content">
         <div class="card-body">
            <div class="resp-container">

       <iframe class="resp-iframe" src="https://www.youtube.com/embed/dQw4w9WgXcQ" gesture="media" allow="encrypted-media" allowfullscreen=""></iframe>
             </div>
        <div class="play-action row">
       <div class="col-lg-6 col-sm-12 col-12">
       <ul class="action-bar-player-right nav">
       <li class="nav-item">
           <button type="button" class="btn btn-icon btn-warning mr-1 mb-1 waves-effect waves-light"><i class="fas fa-arrow-right"></i></button>
              </li>
      <li class="nav-item">
       <button type="button" class="btn btn-icon btn-warning mr-1 mb-1 waves-effect waves-light"><i class="fas fa-arrow-left"></i></button>
      </li>

       </ul>
     </div>
       <div class="col-lg-6 col-sm-12 col-12">
       <ul class="action-bar-player-left nav justify-content-end">
           <li class="nav-item">
            <button type="button" class="btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light"><i class="fas fa-calendar-alt"></i></button>
        </li>
    <li class="nav-item">
       <button type="button" class="btn btn-icon btn-icon rounded-circle btn-warning mr-1 mb-1 waves-effect waves-light"><i class="far fa-bookmark"></i></button>

    </li>
    </ul>
    </div>

    </div>
    </div>
     </div>
      </div>

          <div class="col-lg-3 col-sm-12 col-12">
          <div class="card-content">
         <div class="card-body">
          <div class="dropdown">
         <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Drop bottom right
           </button>
           <div class="dropdown-menu dropdown-menu-right">

           </div>
            </div>
             <!-- Nav tabs -->
       <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
       <li class="nav-item">
       <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill" role="tab" aria-controls="home-fill" aria-selected="true">Home</a>
       </li>
       <li class="nav-item">
       <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">Profile</a>
       </li>
       <li class="nav-item">
       <a class="nav-link" id="messages-tab-fill" data-toggle="tab" href="#messages-fill" role="tab" aria-controls="messages-fill" aria-selected="false">Messages</a>
       </li>

       </ul>

             <!-- Tab panes -->
       <div class="tab-content pt-1">
       <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">
       <p>Use <code>optgroup</code> 1111111111111111</p>

       <div class="list-group" id="list-tab" role="tablist">
         <button href="http://www.youtube.com/embed/Q5im0Ssyyus" target="resp-iframe" class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" role="tab" aria-controls="list-home" aria-selected="false">Home <small class="smtext-bn-simo">HD</small></button>
         <button href="http://www.youtube.com/embed/Q5im0Ssyyus" target="resp-iframe" class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" role="tab" aria-controls="list-home" aria-selected="false">Home <small class="smtext-bn-simo">HD</small></button>
         <button href="http://www.youtube.com/embed/Q5im0Ssyyus" target="resp-iframe" class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" role="tab" aria-controls="list-home" aria-selected="false">Home <small class="smtext-bn-simo">HD</small></button>
         <button href="http://www.youtube.com/embed/Q5im0Ssyyus" target="resp-iframe" class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" role="tab" aria-controls="list-home" aria-selected="false">Home <small class="smtext-bn-simo">HD</small></button>
         <button href="http://www.youtube.com/embed/Q5im0Ssyyus" target="resp-iframe" class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" role="tab" aria-controls="list-home" aria-selected="false">Home <small class="smtext-bn-simo">HD</small></button>
           </div>

       </div>
       <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
      <p>Use <code>optgroup</code> 22222</p>
       <div class="form-group">
           <select class="select2 form-control" size="3" style="height: 450PX;">
               <optgroup label="Figures">
                   <option value="romboid">Romboid</option>
                   <option value="trapeze">Trapeze</option>
                   <option value="triangle">Triangle</option>
                   <option value="polygon">Polygon</option>
               </optgroup>
               <optgroup label="Colors">
                   <option value="red">Red</option>
                   <option value="green">Green</option>
                   <option value="blue">Blue</option>
                   <option value="purple">Purple</option>
               </optgroup>
           </select>
       </div>
     </div>
       <div class="tab-pane" id="messages-fill" role="tabpanel" aria-labelledby="messages-tab-fill">
       <p>Use <code>optgroup</code>333333333333</p>
       <div class="form-group">
           <select class="select2 form-control" size="3" style="height: 450PX;">
               <optgroup label="Figures">
                   <option value="romboid">Romboid</option>
                   <option value="trapeze">Trapeze</option>
                   <option value="triangle">Triangle</option>
                   <option value="polygon">Polygon</option>
               </optgroup>
               <optgroup label="Colors">
                   <option value="red">Red</option>
                   <option value="green">Green</option>
                   <option value="blue">Blue</option>
                   <option value="purple">Purple</option>
               </optgroup>
           </select>
       </div>
       </div>
        </div>
         </div>
          </div>
              </div>
                  </div>
                  
      </div>
        <script>

               $(document).ready(function(){
               $("button").click(function(e) {
                   e.preventDefault();

                   $(".resp-iframe").attr("src", $(this).attr("href"));


           });


           });
           </script>
        @endsection
