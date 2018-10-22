<section class="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="title">
					<p>О нас</p>
				</div>
				<div class="creators">
					<p>Мы — Екатерина и Салих, создатели компании SWIUND</p>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="about-image">
					<img class="responsive-img" src="/images/about/Creators.jpg" alt="Creators">
				</div>
				<div class="about-description">
					<p>Места, Где живут обезьяны, Характеризуются теплым климатом. В основном к территории, на которой можно встретить обезьян относят страны Центральной и Южной Америки. Встречаются обезьяны и в Африки, и в Азии. Естественные среды обитания приматов, конечно же, ограничиваются этими странами, но в современном мире мета, где живут обезьяны можно значительно расширить за счет множества зоопарков, в которых обязательно представлены виды этих животных. </p>
					<p>Природная среда обитания животных ставит зачастую под угрозу их жизни, потому что за обезьянами очень часто охотятся браконьеры, чтобы потом продать их в богатые дома, где они будут служить одним из видов развлечений для господ. Часто обезьян продают в исследовательские лаборатории, где на них ставят опыты, порою очень жестокие, поскольку ДНК обезьян наиболее близко ДНК человека.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="swiund-insta">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="title">
					<p>Мы в INSTAGRAM @SWIUND</p>
				</div>
			</div>

			<?
				$res = file_get_contents("https://api.instagram.com/v1/users/self/media/recent?access_token=8240707827.0ff88cd.a9d2b8a310ce47e8b7c83b44c6b22c76&count=6");
				foreach (json_decode($res)->data as $post) {
					$image = $post->images->standard_resolution->url;
					$url = $post->link;
					echo <<<INSTA
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="insta-image">
								<a href="$url"><img class="responsive-img" src="$image" alt="Post"></a>
							</div>
						</div>
INSTA;
				}
			?>
		</div>
	</div>
</section>