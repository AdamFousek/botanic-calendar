@extends('emails.layout')

@section('content')
<center style="width: 100%; background-color: #f1f1f1;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo" style="text-align: left;">
                                <h1><a href="#">Shop</a></h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white" style="padding: 2em 0 2em 0;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="padding: 0 2.5em; text-align: left;">
                                <div class="text">
                                    <h2>Ronald your shopping cart misses you</h2>
                                    <h3>Amazing deals, updates, interesting news right in your inbox</h3>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr>
                <table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                        <th width="80%" style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 20px">Item</th>
                        <th width="20%" style="text-align:right; padding: 0 2.5em; color: #000; padding-bottom: 20px">Price</th>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                        <td valign="middle" width="80%" style="text-align:left; padding: 0 2.5em;">
                            <div class="product-entry">
                                <img src="images/prod-1.jpg" alt="" style="width: 100px; max-width: 600px; height: auto; margin-bottom: 20px; display: block;">
                                <div class="text">
                                    <h3>Analog Wrest Watch</h3>
                                    <span>Small</span>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                </div>
                            </div>
                        </td>
                        <td valign="middle" width="20%" style="text-align:left; padding: 0 2.5em;">
                            <span class="price" style="color: #000; font-size: 20px;">$120</span>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                        <td valign="middle" width="80%" style="text-align:left; padding: 0 2.5em;">
                            <div class="product-entry">
                                <img src="images/prod-2.jpg" alt="" style="width: 100px; max-width: 600px; height: auto; margin-bottom: 20px; display: block;">
                                <div class="text">
                                    <h3>Analog Wrest Watch</h3>
                                    <span>Small</span>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                </div>
                            </div>
                        </td>
                        <td valign="middle" width="20%" style="text-align:left; padding: 0 2.5em;">
                            <span class="price" style="color: #000; font-size: 20px;">$120</span>
                        </td>
                    </tr>
                    <tr>
                        <td valign="middle" style="text-align:left; padding: 1em 2.5em;">
                            <p><a href="#" class="btn btn-primary">Continue to your order</a></p>
                        </td>
                    </tr>
                </table>
            </tr><!-- end tr -->
            <!-- 1 Column Text + Button : END -->
        </table>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="middle" class="bg_light footer email-section">
                    <table>
                        <tr>
                            <td valign="top" width="33.333%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-right: 10px;">
                                            <h3 class="heading">About</h3>
                                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" width="33.333%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                            <h3 class="heading">Contact Info</h3>
                                            <ul>
                                                <li><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                                                <li><span class="text">+2 392 3929 210</span></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" width="33.333%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-left: 10px;">
                                            <h3 class="heading">Useful Links</h3>
                                            <ul>
                                                <li><a href="#">Home</a></li>
                                                <li><a href="#">Account</a></li>
                                                <li><a href="#">Wishlist</a></li>
                                                <li><a href="#">Order</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end: tr -->
            <tr>
                <td class="bg_white" style="text-align: center;">
                    <p>No longer want to receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
                </td>
            </tr>
        </table>

    </div>
</center>
@endsection
