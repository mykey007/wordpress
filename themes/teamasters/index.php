<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage American Tea Masters Home Page
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<script type="text/javascript">
		function ImagenesObj() {
		n=0;
		this[n++]="http://teamasters.org/jpg/home1.jpg";
		this[n++]="http://teamasters.org/jpg/home2.jpg";
		this[n++]="http://teamasters.org/jpg/home3.jpg";
		this[n++]="http://teamasters.org/jpg/home1.jpg";
		this.N=n;
		}
		var Imagenes=new ImagenesObj();
		src= Imagenes[ Math.floor(Math.random() * Imagenes.N) ] ;
		document.write("<img src="+src+" class='wp-post-image home-img' />");
</script>
	<div id="primary" class="site-content">

		<div id="content" role="main">
			<h1>Become a Certified Tea Master<sup>TM</sup></h1>
			<p>The American Tea Masters Association is an internationally recognized, membership-based organization founded to 
				provide Mastery Level training, education, and professional certification to individuals desiring to become tea masters and tea sommeliers.
			</p>
			<p>The association is respected as meeting superior educational standards by offering its Tea Mastery Certification Course<sup>TM</sup> for achieving 
				the prestigious Certified Tea Master<sup>TM</sup> designation upon completion of the coursework.
			</p>

<br /><br /><br />
<?php
//get specific post_types, display all published content for each of those types
	$args=array(
		'name' => 'certification-course'
	);
	$output = 'objects'; // names or objects
	$post_types=get_post_types($args,$output);
	if ($post_types) {
		foreach ($post_types as $post_type ) {
		$type = $post_type->name;
		$args=array(
			'post_type'			=> $type,
			'post_status' 		=> 'publish',
			'posts_per_page'	=> 15,
			'caller_get_posts'	=> 1,
			'order'           	=> 'ASC',
		);
		$my_query = null;
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) {
			echo "<h2>Tea Mastery Certification Course<sup>TM</sup> : </h2>";
			while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<?php the_title(); ?>   
			<span><!--<a href="<?php the_permalink(); ?>">--><?php the_excerpt() ?><!--</a>--></span>
			<!-- use spans to make the home page lok like it does, maybe add some custom post meta blocks -->
			<?php
			endwhile;
		}
		wp_reset_query();
		}
	}

?> 

<?php
//get specific post_types, display all published content for each of those types
	$args=array(
		'name' => 'blending-course'
	);
	$output = 'objects'; // names or objects
	$post_types=get_post_types($args,$output);
	if ($post_types) {
		
		foreach ($post_types as $post_type ) {
		$type = $post_type->name;
		$args=array(
			'post_type' 		=> $type,
			'post_status' 		=> 'publish',
			'posts_per_page'	=> 10,
			'caller_get_posts'	=> 1,
			'order'           	=> 'ASC',
		);
		$my_query = null;
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) {
			echo "<h2>Certified Tea Blending Course<sup>TM</sup> :</h2>";
			while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<?php the_title(); ?>   
			<a href="<?php the_permalink(); ?>"><?php the_excerpt() ?></a>
			<?php
			endwhile;
		}
		wp_reset_query();
		}
	}

?> 

<h2>Worldwide Training by Location</h2>
<img class="wp-post-image" src="http://teamasters.org/images/world_map_3.jpg" alt="training tea mastery to people world wide" />
<br />
<table cellspacing="0" cellpadding="0" border="0" align="center">
                    <tbody><tr valign="baseline" align="left"> 
                      <td valign="baseline" align="left" class="texto"> 
                        <div align="center"><strong><font size="2" color="#000000">Training 
                          Territory</font></strong></div></td>
                      <td class="texto"> 
                        <div align="center"><strong><font size="2" color="#000000">Certified 
                          Tea Master</font></strong></div></td>
                      <td class="texto"> 
                        <div align="center"><strong><font size="2" color="#000000">Contact</font></strong> 
                        </div></td>
                    </tr>
                    <tr valign="baseline" align="left"> 
                      <td class="texto"><font color="#000000"> 
                        Western-half USA </font></td>
                      <td class="texto"> <font color="#000000">Chas 
                        Kroll </font> </td>
                      <td valign="baseline" align="center" class="texto"> <div align="center"><font color="67461d"><span class="texto_news"><span class="texto"></span></span> 
                          <span class="texto_news"><span class="texto"><a style="text-decoration:none" class="news_title" target="_self" href="mailto:chaskroll@teasters.org">Email</a></span></span></font></div></td>
                    </tr>
                    <tr valign="baseline" align="left"> 
                      <td class="texto"><font color="#000000">Eastern-half 
                        USA</font></td>
                      <td class="texto"> <font color="#000000">Lady 
                        Kelly MacVean</font></td>
                      <td valign="baseline" align="center" class="texto"> <div align="center"><a style="text-decoration:none" class="news_title" target="_self" href="mailto:kelly.macvean@gmail.com">Email</a></div></td>
                    </tr>
                    <tr valign="baseline" align="left"> 
                      <td class="texto"><font color="#000000">Canada 
                        &amp; Alaska, France</font></td>
                      <td class="texto"> <font color="#000000">Sylvana 
                        Levesque</font></td>
                      <td class="texto"> <div align="center"><a href="mailto:kelly.macvean@gmail.com"><font color="67461d"><span class="texto_news"><span class="texto"></span></span></font></a><font color="67461d"><span class="texto_news"><span class="texto"><a style="text-decoration:none" class="news_title" target="_self" href="mailto:sylvanalevesque@teamasters.ca%20">Email</a></span></span></font></div></td>
                    </tr>
                    <tr valign="baseline" align="left"> 
                      <td class="texto"><font color="#000000"> 
                        South &amp; Central America </font></td>
                      <td class="texto"> 
                        <!--R4C2-->
                        <font color="#000000">Diego Morlachetti &amp;</font> </td>
                      <td class="texto"> 
                        <!--R4C3-->
                      </td>
                    </tr>
                    <tr class="texto"> 
                      <td class="texto"> <font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        Mexico, Spain</font></td>
                      <td class="texto"> 
                        <!--R5C2-->
                        &nbsp;&nbsp;&nbsp;&nbsp; <font color="#000000">Liliana 
                        Venarucci<br>
                        </font></td>
                      <td class="texto"> <div align="center"><a style="text-decoration:none" class="news_title" target="_self" href="mailto:diego@agni.com.ar">Email</a></div></td>
                    </tr>
                    <tr class="texto"> 
                      <td class="texto"><font color="#000000"> 
                        Australia, New Zealand</font></td>
                      <td class="texto"> 
                        <!--R6C2-->
                      </td>
                      <td class="texto"> 
                        <!--R6C3-->
                      </td>
                    </tr>
                    <tr> 
                      <td class="texto"> <font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        Southeast Asia</font></td>
                      <td class="texto"> 
                        <!--R7C2-->
                        <font color="#000000">Sharyn Johnston</font></td>
                      <td class="texto"><div align="center"><a href="mailto:diego@agni.com.ar"><font color="67461d"><span class="texto_news"><span class="texto"></span></span></font></a><font color="67461d"><span class="texto_news"><span class="texto"><a style="text-decoration:none" class="news_title" target="_self" href="mailto:info@australianteamasters.com.au">Email</a></span></span></font></div></td>
                    </tr>
                    <tr> 
                      <td class="texto"><font color="#000000">Scandinavia</font></td>
                      <td class="texto"> <font color="#000000">Catrin 
                        Rudling </font></td>
                      <td class="texto"> <div align="center"><a href="mailto:kelly.macvean@gmail.com"><font color="67461d"><span class="texto_news"><span class="texto"></span></span></font></a><font color="67461d"><span class="texto_news"><span class="texto"><a style="text-decoration:none" class="news_title" target="_self" href="mailto:catrin@mightyleaf.se ">Email</a></span></span></font></div></td>
                    </tr>
                  </tbody></table>
					<p>The Tea Mastery Certification Course<sup>TM</sup> is also available without leaving your home or office, all done using Skype, 
						a free audio-visual system you can download to your computer. The entire course is conducted one-on-one with your own certified 
						tea master. Click Here for information.
					</p>
					<p>Review the results of our January, 2011 survey of several of our graduates: The Value of Becoming a Certified Tea Master<sup>TM</sup>. 
						Loaded with great feedback.
					</p>
					<p>Please take a moment to read the Testimonials from several registrants who completed the Tea Mastery Certification Course<sup>TM</sup>. 
						Biographies of several Certified Tea Masters<sup>TM</sup> are also available.
					</p>
					<p>Our 190-page book, Tea Mastery - Pursuing Your Odyssey Into Tea, published last year, follows the rigorous curriculum for training a 
						Certified Tea Master<sup>TM</sup>. Comes with 38 different teas for tasting and evaluation, 100 extra Tea Evaluation Forms, 
						and opportunity to become a Certified Tea Professional<sup>TM</sup>. Click Here for information. 
					</p>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>