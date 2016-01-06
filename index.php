<?php
if(isset($_POST['msearch'])){
	$search=htmlspecialchars($_POST['msearch'],ENT_QUOTES);
	// ファイルからJSONを読み込み
	$json = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=002e50c7a2505b32c630b7bd2f07b82b&query=".$search."%");

	// 文字化けするかもしれないのでUTF-8に変換
	$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	// オブジェクト毎にパース
	// trueを付けると連想配列として分解して格納してくれます。
	$obj = json_decode($json, true);
 
	// パースに失敗した時は処理終了
	if ($obj === NULL) {
	return;
	}
/*パースする時の確認用
echo '<pre>';
print_r($obj);
echo '</pre>';
*/
}



?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>海外映画検索</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <!--[if lt IE 9]>
            <script src="js/vendor/html5-3.6-respond-1.4.2.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">海外映画を検索しちゃう</h1>
                <!--
                <nav>
                    <ul>
                        <li><a href="#">nav ul li a</a></li>
                        <li><a href="#">nav ul li a</a></li>
                        <li><a href="#">nav ul li a</a></li>
                    </ul>
                </nav>
                -->
            </header>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">

                <article>
                    <header>
                        <h1>映画検索</h1>
						<div class="search">
							<form method="post" action="">
								<input type="text" name="msearch" class="search"placeholder="ここに映画のタイトルを英語で記入してね" required>
								<input type="submit" value="検索する">		
							
							</form>
						</div>
						
                    </header>
                    
                    <section>
                    	<?php 
                    		if(isset($_POST['msearch'])):
                    			foreach($obj['results'] as $movie):?>
                    				<div class="result">
                    					<h2><?php echo $movie['original_title']; ?></h2>
                    						<p>release_date---<?php echo $movie['release_date']; ?></p>
                    						<p>language---<?php echo $movie['original_language']; ?></p>
             								<?php if($movie['poster_path']):?>
                    							<p><img src="http://image.tmdb.org/t/p/w500/<?php echo $movie['poster_path'];?>"></p>
                    						<?php else: ?>
                    							<p>ポスター画像はありません</p>
                    						<?php endif; ?>
                    					<p><?php echo $movie['overview']; ?></p>
							
							
									</div>
						<?php endforeach;endif;?>
                    
                    
                    </section>
                    <!--
                    <section>
                        <h2>article section h2</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra.</p>
                    </section>
                    
                    <footer>
                        <h3>article footer h3</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor.</p>
                    </footer>
                    -->
                </article>

                <aside>
                    <h3>apiの練習用に作りました</h3>
                    <p>
                    The Movie Database Apiをつかっています。
                    リクエストするとJSON形式で結果が返ってきます
                    あとはそれをパースするだけです。<br>
                  
                    参考のためにソースコードをgithubにあげています。<br>
                    index.phpにプログラムを書いております。<br>
                    <a href="https://github.com/makotoschool/movie_api" target="blank">https://github.com/makotoschool/movie_api</a>	
                    </p>
                </aside>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                <h3>footer</h3>
            </footer>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
