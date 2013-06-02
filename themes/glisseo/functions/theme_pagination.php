<?php
function pagination($start_end_links = 3, $middle_links = 3)
{
	global $wp_query;		
	// No Pagination if is single
	if(!is_single())	
	{			
		$current = get_query_var('paged') == 0 ? 1 : get_query_var('paged');	// This Page
		$total = $wp_query->max_num_pages;										// All Pages
		$links_left = floor(($middle_links - 1) / 2);							// Left Links
		$links_right = ceil(($middle_links - 1) / 2);							// Right Links
		if($total > 1)	
		{				
			echo '<div class="page-navi"><ul>';
			// Run through all Pages
				for($i=1; $i<=$total; $i++)	
				{
					// Current Page
					if($i == $current)
					{
						echo '<li>
						<a href="#" class="current"><span>'.($current).'</span></a>
						</li>
						';
					}
					// The Others
					elseif($i >= ($current - $links_left) && $i <= ($current + $links_right) || $i <= $start_end_links || $i > ($total - $start_end_links))
					{
						echo '<li>
							<a href="'.get_pagenum_link($i).'">'.$i.'</a>
						</li>
						';
					}
					// auszulassene Seiten
					elseif($i == ($start_end_links + 1) && $i < ($current - $links_left + 1) || $i == ($total - $start_end_links) && $i > ($current + $links_right))
					{
						echo '<li>
						<a href="#">...</a>
						</li>
						';
					}
				}
			//Next/Prev Links
				if($current<$total){
					echo '<li>
					<a href="'.get_pagenum_link($current+1).'">'.__("Next","tb_glisseo").'</a>
					</li>
					';
					echo '<li>
					<a href="'.get_pagenum_link($total).'">'.__("Last","tb_glisseo").'</a>
					</li>
					';
				}
				else{
					echo '<li>
					<a href="'.get_pagenum_link(1).'">'.__("First","tb_glisseo").'</a>
					</li>
					';
					echo '<li>
					<a href="#" class="current">'.__("Last","tb_glisseo").'</a>
					</li>
					';
				}
			// The End
			echo '</ul></div>';
		}
	}
}
?>