Add the content of the ad to the html field and give it a relative weighting. Weighting works such that if an item has a weighting of 6 and the sum of all weightings is 12 then that item would be shown half the time. In the same set an item with a weighting of 1 would be shown 1/12th of the time. An item with a weighting of 0 will not be shown. See the following example html content. The significant elements are the containing div with class <code>.SpHelloBar</code>, the <code>.SpHelloBar_container</code> link, and the element with the class <code>.SpHelloBar_close</code>
<pre>
<?php  echo htmlentities(
'<div class="SpHelloBar" style="background:#e27e32;">
  <a class="SpHelloBar_container" target="_blank" href="http://www.sitepoint.com/">
    <img class="SpHelloBar_brand" src="http://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2014/05/1399438359popup-logo-sitepoint-white-109x24.png" alt="SitePoint" style="height:24px;">
    <span class="SpHelloBar_message" style="color:#fff;">Sharing Our Passion for Building Incredible Internet Things</span>
    <span class="SpHelloBar_action" style="background:#006aaa;">Click Me</span>
  </a>
  <span class="SpHelloBar_close">&times;</span>
</div>'
); ?>
</pre>
