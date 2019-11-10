<:foreach var="${data.games}" val="result">
			<div class="game loaded-item">
				<a href="/play/${normalize(${result.name})}" class="game-holder">
					<span class="game-img">
						<:set var="imgSrc" val="${result.logo}"/>
						<:set var="noImgSrc" val="public/build/images/games/default_game_ss.png"/>
						<img src=${imgSrc} onerror="this.src='/${noImgSrc}';" alt="${result.name}" width="300" height="220">
					</span>
					<span class="game-desc">
						<span class="game-title">${result.name}</span>
						<span class="game-options">
							<span class="game-played">
								<span class="game-play">
									<i class="icon-play"></i>
								</span>
								<span class="game-played-label">Times played:</span> ${result.times_played}
							</span>
							<span class="game-soft">${result.manufacturer}</span>
						</span>
					</span>
				</a>
			</div>
		</:foreach>