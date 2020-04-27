<?php


print <<<EOF
<form action=index.php method=post>
  <table><TR><TD width=400>
  <textarea name=tweet class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </td><TD>
  <button type="submit" class="btn btn-primary">Tweet</button>
  </td></tr></table>
</form>
EOF;