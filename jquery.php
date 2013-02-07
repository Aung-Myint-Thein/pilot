<html lang="en">
<head>
<meta charset="utf-8" />
<title>jQuery UI Accordion - No auto height</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
$( "#accordion" ).accordion({
heightStyle: "content"
});
});
</script>
</head>
<body>
<div id="accordion">
<h3>Section 1</h3>
<div>
<p>Mauris mauris ante, blandit et, ultrices a, susceros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</p>
</div>
<h3>Section 2</h3>
<div>
<p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna. </p>
</div>
<h3>Section 3</h3>
<div>
<p>Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui. </p>
<ul>
<li>List item</li>
<li>List item</li>
<li>List item</li>
<li>List item</li>
<li>List item</li>
<li>List item</li>
<li>List item</li>
</ul>
</div>
</div>
</body>
</html>