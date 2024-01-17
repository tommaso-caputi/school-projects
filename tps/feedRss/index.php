<?php
    $rss_data_url = "http://www.e-compass.it/rss/getRSS.php?url=" . urlencode("http://www.e-compass.it/rss/getRSS.php?url=https://rss.nytimes.com/services/xml/rss/nyt/World.xml");
    $rss_data = file_get_contents($rss_data_url);
    $rss = new SimpleXMLElement($rss_data);
    echo "<h1>New York Times feed</h1>";
    foreach ($rss->channel->item as $item) {
        $title = $item->title;
        $description = $item->description;
        $link = $item->link;
        $image_url = "";
        if ($item->enclosure) {
            $image_url = $item->enclosure['url'];
        }
        echo "<h3>$title</h3>";
        echo "<p>$description</p>";
        echo "<a href='$link'>Leggi di più</a>";
        if ($image_url) {
            echo "<br>";
            echo "<a href='$link'><img src='$image_url'></a>";
        }
        echo "<hr>";
    }

?>