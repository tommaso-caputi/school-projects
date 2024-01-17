<?php
function fetchRSSFeed($url)
{
    $xml = file_get_contents($url);
    $rss = simplexml_load_string($xml);
    return $rss;
}
//$rss = fetchRSSFeed("https://www.repubblica.it/rss/homepage/rss2.0.xml");
$rss = fetchRSSFeed("https://rss.nytimes.com/services/xml/rss/nyt/World.xml");
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
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="57x57" href="./favicon/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="./favicon/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="./favicon/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="./favicon/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="./favicon/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="./favicon/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="./favicon/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="./favicon/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="./favicon/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png" />
    <link rel="manifest" href="./favicon/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="./favicon/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />
    <title>News New York Times</title>
    <script src="https://kit.fontawesome.com/eaa4609b2f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <div class="preloader">
        <div></div>
        <div>Caricamento!</div>
    </div>

    <nav>
        <div class="container">
            <div class="logo">
                <i class="fas fa-globe fa-3x"></i>
                <h1>News<span>&ensp;New York Times</span></h1>
            </div>
        </div>
    </nav>

    <section>
        <div class="container">
            <h1 class="editor-h1">Categoria</h1>
            <form action="" method="get">
                <select name="category" id="category" onchange="this.form.submit()">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category; ?>" <?php echo ($selectedCategory == $category) ? 'selected' : ''; ?>><?php echo $category; ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
            <br>
            <div class="articles">
                <!-- <a href="./html/article.html" class="card">
                    <img src="./images/articles/ent1.jpg" alt="" />
                    <article>
                        <p class="entertainment-category">Entertainment</p>
                        <h1>Lorem ipsum dolor sit amet.</h1>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi
                            nisi neque eum libero maiores voluptatem repudiandae quos
                            perspiciatis, reiciendis dolor!
                        </p>
                    </article>
                </a> -->
                <?php if ($filteredItems) {
                    foreach ($filteredItems as $item) {
                        echo '<a href="' . $item->link . '" class="card">
                        <img src="' . $item->children('media', True)->content->attributes()->url . '" alt="" />
                        <article>
                            <p class="entertainment-category">' . $item->category . '</p>
                            <h1>' . $item->title . '</h1>
                            <p>' . $item->description . '</p>
                        </article>
                    </a>';
                    }
                } else {
                    echo '<p>No items found.</p>';
                }
                ;
                ?>
            </div>
        </div>
    </section>


    <script src="./js/script.js"></script>
</body>

</html>