<?php

class CS_Slider extends Cornerstone_Element_Base {

  public function data() {
    return array(
      'name'        => 'slider',
      'title'       => __( 'Slider', csl18n() ),
      'section'     => 'media',
      'description' => __( 'Slider description.', csl18n() ),
      'supports'    => array( 'id', 'class', 'style' ),
      'childType'   => 'slide',
      'renderChild' => true
    );
  }

  public function controls() {

    $this->addControl(
      'elements',
      'sortable',
      __( 'Slides', csl18n() ),
      __( 'Add a new slide to your slider.', csl18n() ),
      array(
        array( 'title' => __( 'Slide 1', csl18n() ), 'content' => '<img src="http://placehold.it/1200x600/3498db/2980b9" alt="Placeholder">' ),
        array( 'title' => __( 'Slide 2', csl18n() ), 'content' => '<img src="http://placehold.it/1200x600/9b59b6/8e44ad" alt="Placeholder">' )
      ),
      array(
        'newTitle' => __( 'Slide %s', csl18n() ),
        'floor'    => 1
      )
    );

    $this->addControl(
      'animation',
      'select',
      __( 'Animation', csl18n() ),
      __( 'Choose between a fade and a slide animation.', csl18n() ),
      'slide',
      array(
        'choices' => array(
          array( 'value' => 'fade',  'label' => __( 'Fade', csl18n() ) ),
          array( 'value' => 'slide', 'label' => __( 'Slide', csl18n() ) )
        )
      )
    );

    $this->addControl(
      'slide_speed',
      'number',
      __( 'Animation Speed', csl18n() ),
      __( 'The amount of time in milliseconds the transition between each slide should take.', csl18n() ),
      '1000'
    );

    $this->addControl(
      'slideshow',
      'toggle',
      __( 'Slideshow', csl18n() ),
      __( 'Enabling this control will have your slider automatically cycle through like a slideshow.', csl18n() ),
      false
    );

    $this->addControl(
      'slide_time',
      'number',
      __( 'Slide Duration', csl18n() ),
      __( 'The amount of time in milliseconds each slide should remain visible before transitioning to the next one.', csl18n() ),
      '7000',
      array(
        'condition' => array(
          'slideshow' => true
        )
      )
    );

    $this->addControl(
      'random',
      'toggle',
      __( 'Random', csl18n() ),
      __( 'Select to have your slider appear in a random order each time the page loads.', csl18n() ),
      false
    );

    $this->addControl(
      'control_nav',
      'toggle',
      __( 'Control Navigation', csl18n() ),
      __( 'Select to enable the control navigation, which displays how many slides you have in your slider.', csl18n() ),
      false
    );

    $this->addControl(
      'prev_next_nav',
      'toggle',
      __( 'Prev/Next Navigation', csl18n() ),
      __( 'Select to enable the prev/next navigation, which displays two arrows for you to cycle through the slides in your slider.', csl18n() ),
      true
    );

    $this->addControl(
      'no_container',
      'toggle',
      __( 'No Container', csl18n() ),
      __( 'Select to remove the container around the slider.', csl18n() ),
      false
    );

    $this->addControl(
      'touch',
      'toggle',
      __( 'Touch Navigation', csl18n() ),
      __( 'Allow touch devices to navigate with a swipe guesture.', csl18n() ),
      true
    );

  }

  public function render( $atts ) {

    extract( $atts );

    $contents = '';

    foreach ( $elements as $e ) {

      $item_extra = $this->extra( array(
        'id'    => $e['id'],
        'class' => $e['class'],
        'style' => $e['style']
      ) );

      $contents .= '[x_slide' . $item_extra . ']' . $e['content'] . '[/x_slide]';

    }

    $touch = ($touch == 'false') ? 'touch="false"' : '';

    $shortcode = "[x_slider animation=\"$animation\" slide_time=\"$slide_time\" slide_speed=\"$slide_speed\" slideshow=\"$slideshow\" random=\"$random\" control_nav=\"$control_nav\" prev_next_nav=\"$prev_next_nav\" no_container=\"$no_container\" {$touch}{$extra}]{$contents}[/x_slider]";

    return $shortcode;

  }

}