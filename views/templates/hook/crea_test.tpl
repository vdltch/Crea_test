{**
 * Copyright since 2002 Creabilis
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@creabilis.com so we can send you a copy immediately.
 *
 * @author    Creabilis <contact@creabilis.com>
 * @copyright Since 2002 Creabilis
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of Creabilis
 *}

 {foreach $crea_test as $creadesc}
  <div class="">
      <div class="">
          <div class="container">
              {$creadesc.description nofilter}
          </div>
      </div>
  </div>
{/foreach}
