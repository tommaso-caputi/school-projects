<?php
function fetchRSSFeed($url)
{
    $xml = file_get_contents($url);
    $rss = simplexml_load_string($xml);
    return $rss;
}
$rss = fetchRSSFeed("https://www.repubblica.it/rss/homepage/rss2.0.xml");
$categories = $rss->xpath("//item/category");
$categories = array_unique($categories);
$selectedCategory = 'International Relations';
if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    $filteredItems = $rss->xpath("//item[category='$selectedCategory']");
} else {
    $filteredItems = $rss->channel->item;
}
?>

<!DOCTYPE html>
<html>

<body>

        <div >
            <form action="" method="get">
                <select name="category" id="category" onchange="this.form.submit()">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category; ?>" <?php echo ($selectedCategory == $category) ? 'selected' : ''; ?>><?php echo $category; ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
            <br>
            <div>
                <?php if ($filteredItems) {
                    foreach ($filteredItems as $item) {
                        echo '<a href="' . $item->link . '" class="card">
                        <img src="' . $item->children('media', True)->content->attributes()->url . '" alt="" />
                        <div>
                            <h1>' . $item->title . '</h1>
                            <p>' . $item->description . '</p>
                        </div>
                    </a>';
                    }
                } else {
                    echo '<p>Nessuna notizia trovata</p>';
                }
                ;
                ?>
            </div>
        </div>

</body>

</html>