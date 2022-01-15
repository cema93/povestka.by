<?php if( !defined('WPINC') ) die;
/**
 * Leyka Template: Failed donation page block.
 * Description: A template for the interactive actions block shown on the failed donation page.
 **/

$donation_id = leyka_remembered_data('donation_id');
$campaign = null;
$campaign_id = null;

if($donation_id) {

    $donation = new Leyka_Donation($donation_id);
    $campaign_id = $donation ? $donation->campaign_id : null;
    $campaign = new Leyka_Campaign($campaign_id);

}?>

<div id="leyka-pf-" class="leyka-pf">
    <?php include(LEYKA_PLUGIN_DIR.'assets/svg/svg.svg');?>

    <div class="leyka-pf__final-screen leyka-pf__final-error">

        <svg class="svg-icon icon"><use xlink:href="#pic-red-cross"></svg>
        <div class="text"><div class="leyka-js-error-text">Ошибка платежа</div></div>
        <div class="error-text"><div>Мы извиняемся, но по какой-то причине мы не смогли получить ваше пожертвование. Ваши деньги вернутся на ваш счёт. Пожалуйста, попробуйте ещё раз попозже! </div></div>

        <div class="error-text"><div>Подробнее о том, почему произошла ошибка Вы можете уточнить в контакт-центре вашего банка.</div></div>
        <div class="error-text"><div><a href="https://povestka.by/donate/">Попробовать ещё раз</a></div></div>


    </div>

</div>