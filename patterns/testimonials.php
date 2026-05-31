<?php
/**
 * Title: Testimonials
 * Slug: oconee-renovations/testimonials
 * Categories: oconee-renovations
 */

$quote_icon = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/icons/faQuoteLeft.svg';

$testimonials = array(
	array(
		'name'      => 'James Neal Workman, Jr.',
		'honorific' => '',
		'intro'     => 'I am pleased to recommend Mr Unaldi who performed demolition and carpentry work for me personally. The work consisted of the following:',
		'list'      => array(
			'Demolition of the existing finishes and cabinetry',
			'Vertical shiplap wainscoting with decorative cap',
			'Horizontal shiplap in bedroom',
			'Trim and baseboard installation',
			'Installation of bathroom cabinetry and hardware',
		),
		'outro'     => 'His personal knowledge and problem solving ability have been notable. He is personable and has demonstrated the utmost integrity in my dealings with him. I have an unlimited general contractor\'s license and appreciate the skills and values Mr. Unaldi is bringing to our industry.',
	),
	array(
		'name'      => 'John Bleuel',
		'honorific' => 'Professor Emeritus',
		'quote'     => <<<'TEXT'
I am most please to write this recommendation on behalf of Mr. Aytug Unaldi who is a true craftsman and an exemplary worker. I've had the pleasure to see Aytug's work in my own home where he handled several items in a large renovation. His work entailed installing a barn door in our bedroom, floating shelves and pull out drawers in our kitchen, caulking, spackling, painting and replacing the ceiling tiles was meticulous.

Aytug is also an extremely efficient worker. In several instances we asked him to redo the substandard work done by other people. His work was vastly superior and completed in a fraction of time as the original workers. Aytug is very personable, the kind of tradesman anyone would enjoy having in their home. He listened very attentively any ideas or concerns we had and was able to offer ideas and explanations from his comprehensive knowledge of construction.

We were so impressed with Aytug's work that we hope to engage him for other projects in the future. Aytug is very quick and professional, has most impressive work ethic, and his personal integrity is beyond reproach. I give him my absolute highest recommendation. Please feel free to contact me to discuss his sterling credentials.
TEXT,
	),
	array(
		'name'      => 'Tim Dunmyer',
		'honorific' => '',
		'quote'     => <<<'TEXT'
Mr. Aytug Unaldi has been instrumental in my recent kitchen remodel. He designed our built in cabinets and carefully and expertly built them. He is a true Craftsman. His attention to detail and pleasing me as the customer is foremost in his process.

He next installed the kitchen cabinets making sure everything is straight and square in an old house. He carefully designed and crafted several bookcases with doors and hardware. Also installed a kitchen island and helped to modify the granite countertop so our gas cooktop and downdraft exhaust system worked perfectly. He arrived on time and cleaned up before leaving.
TEXT,
	),
	array(
		'name'      => 'Brenda Frady',
		'honorific' => '',
		'quote'     => <<<'TEXT'
Mr Unaldi worked diligently and very professionally on my home bathroom/bedroom remodel project. He put new floors, insulation, cabinets, pocket door and trims in the bathroom. He built new closets and replaced doors for the old ones and trimmed all in the bedroom. He did excellent work in a timely manner and was always pleasant and professional. I highly recommend his work.
TEXT,
	),
	array(
		'name'      => 'Penelope Little',
		'honorific' => '',
		'quote'     => <<<'TEXT'
High Recommendation for Aytug Unaldi. During remodeling of my kitchen, I had the opportunity to know and appreciate Aytug. He called for scheduling, arrived on time, did what was expected and completed the project in a timely manner. He is helpful, creative, trustworthy, and personable. The work Aytug did showed true craftmanship and skill.
TEXT,
	),
	array(
		'name'      => 'Doug Simpson',
		'honorific' => 'Clemson',
		'quote'     => <<<'TEXT'
Aytug's quality of work is exceptional, and he does not take shortcuts. All work was completed on time and budget. In fact, the work was completed well ahead of agreed schedule. As someone who is very detailed, I also appreciated Aytug's great attention to detail. His skills and knowledge show in all aspects of his work and conduct. Aytug is honest, fair, and reliable. The music he plays while he works is also very enjoyable! I am VERY pleased with his work and I highly recommend him.
TEXT,
	),
);
?>

<!-- wp:group {"align":"full","className":"testimonials","backgroundColor":"background-blue","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull testimonials has-background-blue-background-color has-background">
	<!-- wp:heading {"textAlign":"center","level":2,"className":"testimonials__heading"} -->
	<h2 class="wp-block-heading has-text-align-center testimonials__heading">Hear From Our Clients</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"testimonials__grid","layout":{"type":"default"}} -->
	<div class="wp-block-group testimonials__grid">
		<?php foreach ( $testimonials as $testimonial ) : ?>
		<!-- wp:group {"className":"testimonials__card","layout":{"type":"default"}} -->
		<div class="wp-block-group testimonials__card">
			<!-- wp:group {"className":"testimonials__icon-wrap","layout":{"type":"default"}} -->
			<div class="wp-block-group testimonials__icon-wrap">
				<!-- wp:html -->
				<div class="testimonials__quote-icon" aria-hidden="true"><img src="<?php echo esc_url( $quote_icon ); ?>" alt="" width="48" height="48" decoding="async" /></div>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"testimonials__body","layout":{"type":"default"}} -->
			<div class="wp-block-group testimonials__body">
				<?php if ( ! empty( $testimonial['list'] ) ) : ?>
				<!-- wp:paragraph {"className":"testimonials__quote"} -->
				<p class="testimonials__quote"><?php echo esc_html( $testimonial['intro'] ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:list {"className":"testimonials__quote-list"} -->
				<ul class="wp-block-list testimonials__quote-list">
					<?php foreach ( $testimonial['list'] as $item ) : ?>
					<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
				<!-- /wp:list -->

				<!-- wp:paragraph {"className":"testimonials__quote"} -->
				<p class="testimonials__quote"><?php echo esc_html( $testimonial['outro'] ); ?></p>
				<!-- /wp:paragraph -->
				<?php else : ?>
				<!-- wp:paragraph {"className":"testimonials__quote"} -->
				<p class="testimonials__quote"><?php echo esc_html( trim( $testimonial['quote'] ) ); ?></p>
				<!-- /wp:paragraph -->
				<?php endif; ?>
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"className":"testimonials__attribution","layout":{"type":"default"}} -->
			<div class="wp-block-group testimonials__attribution">
				<!-- wp:paragraph {"className":"testimonials__name"} -->
				<p class="testimonials__name"><?php echo esc_html( $testimonial['name'] ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"testimonials__honorific"} -->
				<p class="testimonials__honorific"><?php echo esc_html( $testimonial['honorific'] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
