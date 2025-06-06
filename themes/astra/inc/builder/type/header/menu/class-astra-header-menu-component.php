<?php
/**
 * Menu for Astra theme.
 *
 * @package     astra-builder
 * @link        https://wpastra.com/
 * @since       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ASTRA_HEADER_MENU_DIR', ASTRA_THEME_DIR . 'inc/builder/type/header/menu' );
define( 'ASTRA_HEADER_MENU_URI', ASTRA_THEME_URI . 'inc/builder/type/header/menu' );

/**
 * Heading Initial Setup
 *
 * @since 3.0.0
 */
class Astra_Header_Menu_Component {
	/**
	 * Constructor function that initializes required actions and hooks
	 */
	public function __construct() {
		// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once ASTRA_HEADER_MENU_DIR . '/class-astra-header-menu-component-loader.php';

		// Include front end files.
		if ( ! is_admin() || Astra_Builder_Customizer::astra_collect_customizer_builder_data() ) {
			require_once ASTRA_HEADER_MENU_DIR . '/dynamic-css/dynamic.css.php';
		}
		// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}

	/**
	 * Secondary navigation markup
	 *
	 * @param int    $index index.
	 * @param string $device device.
	 */
	public static function menu_markup( $index, $device = 'desktop' ) {
		$astra_builder = astra_builder();

		switch ( $index ) {
			case 1:
				$theme_location = 'primary';
				$nav_label      = esc_attr__( 'Primary Site Navigation', 'astra' );
				break;
			case 2:
				$theme_location = 'secondary_menu';
				$nav_label      = esc_attr__( 'Secondary Site Navigation', 'astra' );
				break;
			default:
				$theme_location = 'menu_' . $index;
				/* translators: %d: menu index number */
				$nav_label = sprintf( esc_attr__( 'Menu %d Site Navigation', 'astra' ), $index );
				break;
		}

		$_prefix = 'menu' . $index;

		$submenu_class         = apply_filters( 'astra_secondary_submenu_border_class', ' submenu-with-border' );
		$stack_on_mobile_class = 'inline-on-mobile';

		if ( astra_get_option( 'header-' . $_prefix . '-menu-stack-on-mobile' ) ) {
			$stack_on_mobile_class = 'stack-on-mobile';
		}

		// Menu Animation.
		$menu_animation = astra_get_option( 'header-menu' . $index . '-submenu-container-animation' );
		if ( ! empty( $menu_animation ) ) {
			$submenu_class .= ' astra-menu-animation-' . esc_attr( $menu_animation ) . ' ';
		}

		// Menu hover animation.
		$menu_hover_animation = astra_get_option( 'header-' . $_prefix . '-menu-hover-animation' );
		if ( '' !== $menu_hover_animation ) {
			$submenu_class .= ' ast-menu-hover-style-' . esc_attr( $menu_hover_animation ) . ' ';
		}

		/**
		 * Filter the classes(array) for Menu (<ul>).
		 *
		 * @since  3.0.0
		 * @var Array
		 */
		$menu_classes = apply_filters( 'astra_' . $theme_location . '_menu_classes', array( 'main-header-menu', 'ast-menu-shadow', 'ast-nav-menu', 'ast-flex', $submenu_class, $stack_on_mobile_class ) );

		$items_wrap  = '<nav ';
		$items_wrap .= astra_attr(
			'site-navigation',
			array(
				'id'         => apply_filters( 'astra_header_site_navigation_id', esc_attr( $theme_location ) . '-site-navigation-' . esc_attr( $device ) ),
				'class'      => 'site-navigation ast-flex-grow-1 navigation-accessibility site-header-focus-item',
				'aria-label' => $nav_label,
				'itemtype'   => 'https://schema.org/SiteNavigationElement',
				'itemscope'  => 'itemscope',
			)
		);
		$items_wrap .= '>';
		$items_wrap .= '<div class="main-navigation ast-inline-flex">';
		$items_wrap .= '<ul id="%1$s" class="%2$s">%3$s</ul>';
		$items_wrap .= '</div>';
		$items_wrap .= '</nav>';

		// Fallback Menu if primary menu not set.
		$fallback_menu_args = array(
			'theme_location' => $theme_location,
			'menu_id'        => apply_filters( 'astra_header_menu_ul_id', 'ast-hf-menu-' . $index ),
			'menu_class'     => 'main-navigation ast-inline-flex',
			'container'      => 'div',
			'before'         => '<ul class="' . esc_attr( implode( ' ', $menu_classes ) ) . '">',
			'after'          => '</ul>',
			'walker'         => new Astra_Walker_Page(),
			'echo'           => false,
		);

		// To add default alignment for navigation which can be added through any third party plugin.
		// Do not add any CSS from theme except header alignment.
		echo '<div ' . astra_attr( 'ast-main-header-bar-alignment' ) . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( is_customize_preview() ) {
			Astra_Builder_UI_Controller::render_customizer_edit_button();
		}
		if ( has_nav_menu( $theme_location ) ) {
			/** @psalm-suppress ArgumentTypeCoercion */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
			$nav_menu_markup = wp_nav_menu(
				array(
					'menu_id'         => apply_filters( 'astra_header_menu_ul_id', 'ast-hf-menu-' . $index ),
					'menu_class'      => esc_attr( implode( ' ', $menu_classes ) ),
					'container'       => 'div',
					'container_class' => 'main-header-bar-navigation',
					'items_wrap'      => $items_wrap,
					'theme_location'  => $theme_location,
					'echo'            => false,
				)
			);

			// Adding rel="nofollow" for duplicate menu render.
			$nav_menu_markup = $astra_builder->nofollow_markup( $theme_location, $nav_menu_markup );
			echo do_shortcode( $nav_menu_markup );
			/** @psalm-suppress ArgumentTypeCoercion */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
		} else {
			echo '<div class="main-header-bar-navigation ast-flex-1">';
				echo '<nav ';
				echo wp_kses_post(
					astra_attr(
						'site-navigation',
						array(
							'id'         => esc_attr( $theme_location ) . '-site-navigation',
							'class'      => 'site-navigation ast-flex-grow-1 navigation-accessibility',
							'aria-label' => $nav_label,
							'itemtype'   => 'https://schema.org/SiteNavigationElement',
							'itemscope'  => 'itemscope',
						)
					)
				);
				echo '>';
				/** @psalm-suppress ArgumentTypeCoercion */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
				$nav_menu_markup = wp_page_menu( $fallback_menu_args );

				// Adding rel="nofollow" for duplicate menu render.
				$nav_menu_markup = $astra_builder->nofollow_markup( $theme_location, $nav_menu_markup );

				echo do_shortcode( $nav_menu_markup );
				/** @psalm-suppress ArgumentTypeCoercion */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
				echo '</nav>';
			echo '</div>';
		}
		echo '</div>';
	}
}

/**
 *  Kicking this off by creating an object.
 */
new Astra_Header_Menu_Component();
