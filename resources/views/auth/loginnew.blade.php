<div style="display: flex;">
  @include("msg.msg")
</div>

<a href="{{ route('social.oauth') }}?driver=facebook&site_id=6727359" class="btn btn-primary btn-block">
    Login with Facebook
</a>
<a href="{{ route('social.oauth') }}?driver=twitter&site_id=6727359" class="btn btn-info btn-block">
    Login with Twitter
</a>
<a href="{{ route('social.oauth') }}?driver=google&site_id=6727359" class="btn btn-danger btn-block">
    Login with Google
</a>
<a href="{{ route('social.oauth') }}?driver=github&site_id=6727359" class="btn btn-default btn-block">
  Login with Github
</a> 