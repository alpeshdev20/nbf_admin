<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCmsPagesTruncateAndAddData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::table('cms_pages')->truncate();

      Schema::table('cms_pages', function (Blueprint $table) {
        $table->string('slug')->nullable();
      });

        $contentAboutUs = <<<EOT

        <div class="col-12 col-sm-12 text-center mb-3">
            <h2 class="font-weight-bold text-uppercase  line">
              About Us
            </h2>
          </div>
          <div class="col-12 col-sm-12">
            <h3 class=" font-weight-bold text-justify">
              VISION Statement for NETBOOKFLIX
            </h3>
          </div>
          <div class="col-12 col-sm-12">
            <p class="">
                Netbookflix strives to become the world's leading provider of high-quality, affordable educational content, delivered seamlessly to our customers across the globe. Our vision is to create an innovative, diverse, and inclusive platform that brings people together through shared experiences, stories, and emotions. We are committed to fostering creativity, promoting diversity, and empowering our employees and partners to make a positive impact on society."
            </p>
          </div>
          <div class="col-12 col-sm-12">
            <h3 class=" font-weight-bold text-justify">
              PUNCHLINE for NETBOOKFLIX
            </h3>
          </div>
          <div class="col-12 col-sm-12">
            <p class=" text-justify">
            " Stream unlimited knowledge with Netbookflix!"
            </p>
          </div>
          <div class="col-12 col-sm-12">
            <h3 class=" font-weight-bold text-justify">
              MISSION Statement
            </h3>
          </div>
          <div class="col-12 col-sm-12">
            <p class=" text-justify">
             
            <p>"Our mission at Netbookflix is to provide our subscribers with an unparalleled educational experience through a vast selection of high-quality Book plus learning resources, accessible anytime, anywhere.</p><br>

           <p>We aim to inspire and empower our users to acquire new skills, expand their knowledge, and achieve their personal and professional goals. By combining the convenience of online learning with the educational value of streaming services, we strive to make education accessible to all.</p><br>

           <p>We strive to deliver the best user experience possible by continuously improving our platform's functionality, content library, and customer service. We are committed to providing a diverse range of content that represents different perspectives and cultures while maintaining a safe and inclusive environment for our community.</p><br>

            <p>At Netbookflix, we aim to be a leader in the education industry by pushing boundaries and innovating new ways to bring joy to our subscribers."<p>
            </p>
          </div>

        EOT;

        $contentPrivacyPolicy = <<<EOT

        <div class="col-12 col-sm-12 text-center mb-3">&nbsp;</div>
          <div class="col-12 col-sm-12 py-3">
          <p><strong>Privacy Notice</strong></p>
          <p>Netbookflix.com knows that you care how information about you is used and shared and we appreciate your trust in us to do that carefully and sensibly. This notice describes the privacy policy of Netbookflix.com. By visiting Netbookflix.com, you are accepting and consenting to the practices described in this Privacy Notice.</p>
          <ul>
          <li>Controllers of Personal Information</li>
          <li>What Personal Information About Customers Does Netbookflix.com Gather?</li>
          <li>What About Cookies?</li>
          <li>Does Netbookflix.com share the Information it receives?</li>
          <li><b>How Secure is Information About Me?</b></li>
          <li>What Information can I Access?</li>
          <li>What Choices Do I Have?</li>
          <li>Are Children Allowed to Use Netbookflix.com?</li>
          <li>Notices and Revisions</li>
          <li>Examples of Information Collected</li>
          </ul>
          <p>&nbsp;</p>
          <p><strong>Controllers of Personal Information</strong></p>
          <p>Any personal information provided to or gathered by Netbookflix Learning Resource Private Limited under this Privacy Notice will be stored and controlled by Netbookflix Learning Resource Pvt. Ltd. C-2, Sector-1, Noida-201301. UP</p>
          <p><strong>What Personal Information About Customers Does Netbookflix.com Gather?</strong></p>
          <p><strong>&nbsp;</strong></p>
          <p>The information we learn from customers helps us personalise and continually improve your subscription experience at Netbookflix.com. We use your information to assist platform in handling orders, deliver products and services, process payments, communicate with you about orders, products, services and promotional offers, update our records and generally maintain your accounts with us, display content such as wish lists and customer reviews and recommend package and services that might be of interest to you. We also use this information to improve our platform, prevent or detect fraud or abuses of our website and enable third parties to carry out technical, logistical or other functions on our behalf.</p>
          <p>Here are the types of information we gather.</p>
          <p><strong>Information You Give Us:</strong>&nbsp;We receive and store any information you enter on our website or give us in any other way. You can choose not to provide certain information but then you might not be able to take advantage of many of our features. We use the information that you provide for such purposes as responding to your requests, customising future purchasing for you, improving our platform, and communicating with you.</p>
          <p><strong>Automatic Information:</strong>&nbsp;We receive and store certain types of information whenever you interact with us. For example, like website, we use "cookies" and we obtain certain types of information when your Web browser accesses Netbookflix.com or advertisements and other content served by or on behalf of Netbookflix.com on other Web sites. We may also receive/store information about your location and your mobile device, including a unique identifier for your device. We may use this information for internal analysis and to provide you with location-based services, such as advertising, search results, and other personalized content.</p>
          <p><strong>E-mail Communications:</strong>&nbsp;To help us make e-mails more useful and interesting, we often receive a confirmation when you open e-mail from Netbookflix.com if your computer supports such capabilities. We also compare our customer list to lists received from other companies in an effort to avoid sending unnecessary messages to our customers. If you do not want to receive e-mail or other mail from us, please adjust your Customer Communication Preferences.</p>
          <p><strong>Information from Other Sources:</strong>&nbsp;We might receive information about you from other sources and add it to our account information.</p>
          <p>By using or continuing to use the site you agree to our use of your information (including sensitive personal information) in accordance with this Privacy Notice, as may be amended from time to time by Netbookflix.com in its discretion. You also agree and consent to us collecting, storing, processing, transferring and sharing information (including sensitive personal information) related to you with third parties or service providers for the purposes as set out in this Privacy Notice.</p>
          <p>We may be required to share the aforesaid information with government authorities and agencies for the purposes of verification of identity or for prevention, detection or investigation, including of cyber incidents, prosecution and punishment of offences. You agree and consent for Netbookflix.com to disclose your information, if so required, under applicable law.</p>
          <p><strong>What About Cookies?</strong></p>
          <p><strong>&nbsp;</strong></p>
          <ul>
          <li>Cookies are alphanumeric identifiers that we transfer to your computer's hard drive through your Web browser to enable our systems to recognise your browser and to provide features such as Recommended for You, personalised advertisements on other Web sites and storage of items in your Shopping Cart between visits.</li>
          <li>The Help menu on the menu bar of most browsers will tell you how to prevent your browser from accepting new cookies, how to have the browser notify you when you receive a new cookie and how to disable cookies altogether. Additionally, you can disable or delete similar data used by browser add-ons, such as Flash cookies, by changing the add-on's settings or visiting the website of its manufacturer. However, because cookies allow you to take advantage of some of Netbookflix.com essential features, we recommend that you leave them turned on. For instance, if you block or otherwise reject our cookies, you will not be able to add items to your Shopping Cart, proceed to Checkout, or use any Netbookflix.com products and services that require you to Sign in.</li>
          <li>If you do leave cookies turned on, be sure to sign off when you finish using a shared computer.</li>
          </ul>
          <p>&nbsp;</p>
          <p><strong>Does Netbookflix.com share the Information it receives?</strong></p>
          <p><strong>&nbsp;</strong></p>
          <p>Information about our customers is an important part of our business and we are not in the business of selling it to others. Netbookflix.com shares customer information only as described below and with Netbookflix.com and the subsidiaries which Netbookflix Learning Resource Pvt.Ltd. controls and that are either subject to this Privacy Notice or follow practices at least as protective as those described in this Privacy Notice.</p>
          <ul>
          <li><strong>Affiliated Businesses We Do Not Control:</strong>We work closely with affiliated businesses. we provide services jointly with or on behalf of these businesses. Click here for some examples of co-branded and joint offerings. You can tell when a third party is involved in your transactions and we share customer information related to those transactions with that third party.</li>
          <li><strong>Third Party Service Providers:</strong>We employ other companies and individuals to perform functions on our behalf. Examples include fulfilling orders, delivering packages, sending postal mail and e-mail, removing repetitive information from customer lists, analysing data, providing marketing assistance, providing search results and links (including paid listings and links), processing credit card payments and providing customer service. They have access to personal information needed to perform their functions, but may not use it for other purposes. Further, they must process the personal information in accordance with this Privacy Notice and as permitted by applicable law.</li>
          <li><strong>Promotional Offers:</strong>Sometimes we send offers to selected groups of Netbookflix.com customers on behalf of other businesses. When we do this, we do not give that business your name and address. If you do not want to receive such offers, please adjust your Customer Communication Preferences.</li>
          <li><strong>Business Transfers:</strong>As we continue to develop our business, we might sell or buy stores, subsidiaries or business units. In such transactions, customer information generally is one of the transferred business assets but remains subject to the promises made in any pre-existing Privacy Notice (unless, of course, the customer consents otherwise). Also, in the unlikely event that Netbookflix.com or substantially all of its assets are acquired, customer information will of course be one of the transferred assets.</li>
          <li><strong>Protection of Netbookflix.com and Others:</strong>We release account and other personal information when we believe release is appropriate to comply with applicable law; enforce or apply our Conditions of Use and other agreements; or protect the rights, property or safety of Netbookflix.com, our users or others. This includes exchanging information with other companies, organisations, government or regulatory authorities for fraud protection and credit risk reduction. Obviously, however, this does not include selling, renting, sharing or otherwise disclosing personally identifiable information from customers for commercial purposes in a way that is contrary to the commitments made in this Privacy Notice</li>
          <li><strong>With your consent:</strong>Other than as set out above, you will receive notice when information about you might go to third parties and you will have an opportunity to choose not to share the information.</li>
          </ul>
          <p>&nbsp;</p>
          <p><strong>How Secure Is Information About Me?</strong></p>
          <p><strong>&nbsp;</strong></p>
          <ul>
          <li>We work to protect the security of your information during transmission by using Secure Sockets Layer (SSL) software, which encrypts information you input in addition to maintaining security of your information as per the International Standard IS/ISO/IEC 27001 on "Information Technology Security Techniques Information Security Management System-Requirements".</li>
          <li>We reveal only the last four digits of your credit card numbers when confirming an order. Of course, we transmit the entire credit card number to the appropriate credit card company during order processing.</li>
          <li>We maintain physical, electronic and procedural safeguards in connection with the collection, storage and disclosure of personal information (including sensitive personal information). Our security procedures mean that we may occasionally request proof of identity before we disclose personal information to you.</li>
          <li>It is important for you to protect against unauthorised access to your password and to your computer. Be sure to sign off when you finish using a shared computer. Click here for more information on how to sign off.</li>
          </ul>
          <p>&nbsp;</p>
          <p><strong>What Information Can I Access?</strong></p>
          <p><strong>&nbsp;</strong></p>
          <p>Netbookflix.com gives you access to a broad range of information about your account and your interactions with Netbookflix.com for the limited purpose of viewing and, in certain cases, updating that information. This list will change as our website evolves.</p>
          <p><strong>What Choices Do I Have?</strong></p>
          <p><strong>&nbsp;</strong></p>
          <ul>
          <li>As discussed above, you can always choose not to provide information, even though it might be needed to make a purchase or to take advantage of such Netbookflix.com features as Your Profile, Wish Lists, Customer Reviews.</li>
          <li>You can add or update certain information on pages such as those referenced in the Which Information Can I Access? section. When you update information, we usually keep a copy of the previous version for our records. If you do not want to receive e-mail or other mail from us, please adjust your Customer Communication Preferences. (If you do not want to receive Conditions of Use and other legal notices from us, such as this Privacy Notice, those notices will still govern your use of Netbookflix.com and orders placed with Netbookflix.com, and it is your responsibility to review them for changes.)</li>
          <li>If you do not want to receive e-mail or other mail from us, please adjust your Customer Communication Preferences. (If you do not want to receive Conditions of Use and other legal notices from us, such as this Privacy Notice, those notices will still govern your use of Netbookflix.com and orders placed with Netbookflix.com, and it is your responsibility to review them for changes.)</li>
          <li>If you do not want us to use personal information that we gather to personalise advertisements we display to you, please adjust your&nbsp;</li>
          <li>The Help menu on the menu bar of most browsers will tell you how to prevent your browser from accepting new cookies, how to have the browser notify you when you receive a new cookie and how to disable cookies altogether. Additionally, you can disable or delete similar data used by browser add-ons, such as Flash cookies, by changing the add-on's settings or visiting the website of its manufacturer.</li>
          </ul>
          <p>&nbsp;</p>
          <p>However, because cookies allow you to take advantage of some of Netbookflix.com essential features, we recommend that you leave them turned on. For instance, if you block or otherwise reject our cookies, you will not be able to add items to your Cart, proceed to Checkout, or use any Netbookflix.com products and services that require you to Sign in.</p>
          <p><strong>Are Children Allowed to Use Netbookflix.com?</strong></p>
          <p>Use of Netbookflix.com is available only to persons who can form a legally binding contract under the Indian Contract Act, 1872. If you are a minor i.e. under the age of 18 years, you may use Netbookflix.com only with the involvement of a parent or guardian.</p>
          <p><strong>Notices and Revisions</strong></p>
          <p><strong>&nbsp;</strong></p>
          <p>If you have any concern about privacy or grievances at Netbookflix.com, please&nbsp;contact us&nbsp;with a thorough description and we will try to resolve the issue for you.</p>
          <p>Our business changes constantly and our Privacy Notice and the Conditions of Use will change also. We may e-mail periodic reminders of our notices and conditions, unless you have instructed us not to, but you should check our website frequently to see recent changes.</p>
          <p>Unless stated otherwise, our current Privacy Notice applies to all information that we have about you and your account. We stand behind the promises we make, however, and will never materially change our policies and practices to make them less protective of customer information collected in the past without the consent of affected customers.</p>
          <p><strong>Examples of Information Collected</strong></p>
          <p><strong>&nbsp;</strong></p>
          <p><strong>Information You Give Us</strong></p>
          <p>You provide most such information when you search, buy, bid, post, participate in a contest or questionnaire or communicate with customer service. For example, you provide information when you: search for a product; place an order through Netbookflix.com or one of our third-party sellers; provide information in Your Account (and you might have more than one if you have used more than one e-mail address when shopping with us) or Your Profile; communicate with us by phone or otherwise; complete a questionnaire or a contest entry form; compile Wish Lists or other gift registries, provide and rate Reviews; and employ other personal notification services such as such as Available to Order Notifications. As a result of those actions, you might supply us with such information as: your name; address and phone number; credit card information; people to whom purchases have been dispatched (including addresses and phone numbers); content of reviews; the personal description in Your Profile; and financial information.</p>
          <p><strong>&nbsp;</strong></p>
          <p><strong>Automatic Information</strong></p>
          <p>Examples of the information we collect and analyse include: the Internet protocol (IP) address used to connect your computer to the Internet; login; e-mail address; password; computer and connection information such as browser type and version; operating system and platform; purchase history, which we sometimes aggregate with similar information from other customers to create features such as Best Sellers; the full Uniform Resource Locators (URL) clickstream to, through and from our website (including date and time); cookie number; products you viewed or searched for; and any phone number used to call our customer service number. We may also use browser data such as cookies, Flash cookies (also known as Flash Local Shared Objects), or similar data on certain parts of our website for fraud prevention and other purposes. During some visits we may use software tools such as JavaScript to measure and collect session information, including page response times, download errors, length of visits to certain pages, page interaction information (such as scrolling, clicks, and mouse-overs), and methods used to browse away from the page.</p>
          <p><strong>Information from Other Sources</strong></p>
          <p>Examples of information we receive from other sources include: updated delivery and address information from our carriers or other third parties, which we use to correct our records and deliver your next purchase or communication more easily; account information, purchase or redemption information and page-view information from some merchants with which we operate co-branded businesses or for which we provide technical, fulfilment, advertising or other services; search term and search result information from some searches conducted through the Web search features offered by Netbookflix Learning Resource Pvt. Ltd. search results and links, including paid listings (such as Sponsored Links from Overture); and credit history information from credit bureaus, which we use to help prevent and detect fraud and to offer certain credit or financial services to some customers.</p>
          <p><strong>Information You Can Access</strong></p>
          <p>Examples of information you can access easily at Netbookflix.com include: up-to-date information regarding recent orders; personal information (including name, e-mail, password, communications and personalised advertising preferences and address book); payment settings (including credit-card information and gift certificate, gift card and cheque balances); e-mail notification settings (including Alerts, Available to Order notifications, Delivers, Recommended for You and newsletters); recommendations (including recent product-view history, prior-order history and Favourites); Wish Lists and Marketplace seller accounts and Your Profile (including your product Reviews, Requests and Recommendations, your List mania lists, "So You'd Like to..." guides, personal profile, people you tagged as interesting, and Netbookflix Friends).</p>
          <p><strong>Grievance Officer</strong></p>
          <p>Please find below the details of the grievance officer to report Infringement, issues with orders, delivery or subscription</p>
          <p><strong>Email</strong>: support@netbookflix.com</p>
          <p><strong>Address</strong>: Netbookflix Learning Resource Pvt. Ltd.</p>
          <p>C-2,Sector-1, Noida-201301, UP</p>
          <p class="">&nbsp;Click here to report infringement.</p>
          <p class="">Click here to report issues with orders, delivery or subscription.</p>
          </div>

        EOT;

        $contentTermCondition = <<<EOT

        <h1>NETBOOKFLIX subscription Terms and Conditions:</h1>
        <p>Last Updated: July 17, 2020.</p>
        <p>Welcome to the terms and conditions ("<strong>Terms</strong>") for Netbookflix.com. These Terms are between you and Netbookflix Learning Resource Pvt. Ltd. Or its affiliates ("<strong>Netbookflix</strong>" or "<strong>Us</strong>") and govern our respective rights and obligations. Please note that your use of the Netbookflix.com website and subscription to membership are also governed by the agreements listed and linked to below, as well as all other applicable terms, conditions, limitations, and requirements on the Netbookflix.com website, all of which (as changed over time) are incorporated into these Terms. If you sign up for a membership, you accept these terms, conditions, limitations and requirements.</p>
        <ul>
        <li>Conditions of Use and Sale</li>
        <li>com Privacy Notice</li>
        <li>com Terms of Use</li>
        </ul>
        <p>&nbsp;</p>
        <p><strong>Promotional Trial Memberships</strong></p>
        <p>We may sometimes offer trials or other promotional memberships to certain customers, which are subject to these Terms except as otherwise stated in the relevant promotional offers. Such trial or promotional memberships may be subject to conditions prescribed by Netbookflix. These relevant conditions and the term / tenure for such promotional memberships may be different from the Terms. &nbsp;</p>
        <p>Some of such trials or promotional membership may be available to you only in the event Auto Renewal of your Netbookflix membership is enabled for your membership.</p>
        <table width="600" border="1px solid #ffffff">
        <tbody>
        <tr>
        <td style= "padding: 15px">
        <p><strong>Netbookflix Membership Plan</strong></p>
        </td>
        <td style= "padding: 15px">
        <p><strong>Term</strong></p>
        </td>
        </tr>
        <tr>
        <td style= "padding: 15px">
        <p>Annual Netbookflix Membership</p>
        </td>
        <td style= "padding: 15px">
        <p>Yearly (valid for 12 months from date of activation)</p>
        </td>
        </tr>
        <tr>
        <td style= "padding: 15px">
        <p>Monthly Netbookflix Membership</p>
        </td>
        <td style= "padding: 15px">
        <p>Monthly (valid for 1 month from date of activation) *</p>
        <p>*For Monthly Netbookflix Membership, a customer's Netbookflix membership will be due for renewal on a monthly basis. For e.g. if a customer has activated Monthly Prime Membership on 5th of January month, the membership will come up for renewal on 5th of February month.</p>
        </td>
        </tr>
        </tbody>
        </table>
        <p><strong>&nbsp;</strong></p>
        <p><strong>Membership Term</strong></p>
        <p>Membership may be offered by Netbookflix for different terms and tenures. The key memberships are described as under:</p>
        <p>You may select the Netbookflix membership plan of your choice and you can change the Netbookflix membership plan at any time. The payment method(s) eligible to be used for different Netbookflix membership plans may vary, and Netbookflix reserves the sole right to determine the eligible payment methods for each membership plan.</p>
        <p><strong>Fees</strong></p>
        <p>The Library membership fee for Netbookflix is stated in the&nbsp;membership section&nbsp;of our Help pages, for different membership terms, such as a monthly or annual membership, which are offered. The Library membership fee is non-refundable except as expressly set forth in these Terms. Taxes may apply on either or both of the membership fee and the reduced shipping charges for Netbookflix.</p>
        <p>Your membership will be renewed consecutively for such terms, monthly or annual as chosen by you, (such renewal, "<strong>Auto Renewal</strong>"), if the payment method you have chosen for making payments towards your membership supports Auto Renewal. In cases where you select an eligible payment method, the payment of the membership fees will be on a recurring basis (such payments, "<strong>Recurring Payments</strong>") and you authorize us to collect the membership fee for the next membership terms(s).</p>
        <p>In the event Recurring Payments is enabled for your library membership, you agree to be bound by the 'Recurring Payments for Netbookflix Library - Terms &amp; Conditions', &nbsp;</p>
        <p>You have the sole right to decide to cancel or disable the Auto Renewal of your library membership either by contacting Netbookflix customer support or in the settings or preferences of your Netbookflix.com account.</p>
        <p>By signing-up for Library membership, you confirm that you are a resident of India. You cannot use a credit or debit card issued outside India to pay for any membership fee for library. Paid Library membership only becomes effective upon successful authorization of payment or successfully enabling Recurring Payments (for Auto Renewal of your membership) through the Netbookflix.com website (as the case may be).</p>
        <p>If Auto Renewal of your Library membership has been enabled your membership will renew automatically for a membership term one after the other, unless you expressly select to cancel or disable Auto Renewal or Recurring Payments for your Library membership.</p>
        <p>For the avoidance of doubts, it is clarified that once Auto Renewal has been enabled, monthly Library memberships renew automatically on a monthly basis and annual Library memberships renew automatically on an annual basis.</p>
        <p><strong>Delivery Benefits and Eligible Purchases for Library</strong></p>
        <p>Library delivery benefit&nbsp;depends upon availability. They are limited to certain products displayed on the Netbookflix.com platform. Products eligible for Library will be designated as such on their product pages. Some special product, order, handling fees, and/or taxes may still apply to eligible purchases.&nbsp;</p>
        <p><strong>Other Limitations</strong></p>
        <ul>
        <li>We reserve the right to accept or refuse membership in our discretion.</li>
        <li>We may send you email and other communications related to Library and your Library membership (regardless of any settings or preferences related to your Netbookflix account).</li>
        <li>You may not transfer or assign your Library membership or any Library benefits, except as allowed in these Terms.</li>
        <li>Library members are not permitted to purchase products for the purpose of resale, rental, or to ship to their customers or potential customers using Library benefits.</li>
        <li>From time to time, Netbookflix may choose in its sole discretion to add or remove Library membership benefits.</li>
        </ul>
        <p>&nbsp;</p>
        <p><strong>Membership Activation</strong></p>
        <p>Your paid Library membership will be activated only on successful payment for Library membership made through the Netbookflix.com website/platform.</p>
        <p><strong>Membership Cancellation</strong></p>
        <p>You may cancel your Paid Library membership any time by visiting your Account and adjusting your membership settings on Library Central. If you cancel the annual Library membership within 3 business days of signing up for such paid Library membership, we will issue a credit note to you and refund your full membership fee, provided that we may charge you (or withhold from your refund) the value of Library benefits used by you and your account during this 3 business day period by issuing a partial credit note to you. If you cancel the annual Library membership at any other time, we will raise a credit note and refund your full membership fee only if you have not made any eligible purchases or taken advantage of Library benefits since your latest Library membership charge.</p>
        <p>If you cancel a monthly Library membership, the membership fee will be refunded only if you have not made any eligible use or taken advantage any of the Library benefits since your latest Library membership charge.</p>
        <p>For the avoidance of doubt, the cancellation and refund process provided under this section, shall apply to you irrespective of whether Auto Renewal or Recurring Payments has been enabled for your Library membership or not.</p>
        <p><strong>Agreement Changes</strong></p>
        <p>We may in our discretion change these Terms, Netbookflix.com Conditions of Use, Conditions of Sale and Privacy Notice, or any aspect of Library membership, without notice to you. If any change to these terms is found invalid, void, or for any reason unenforceable, that change is severable and does not affect the validity and enforceability of any remaining changes or conditions. YOUR CONTINUED MEMBERSHIP AFTER WE CHANGE THESE TERMS CONSTITUTES YOUR ACCEPTANCE OF THE CHANGES. IF YOU DO NOT AGREE TO ANY CHANGES, YOU MUST CANCEL YOUR MEMBERSHIP.</p>
        <p><strong>Termination by Us</strong></p>
        <p>We may terminate your Library membership at our discretion without notice. If we do so, we will issue a credit note to you and give a prorated refund based on the remaining term of your then membership term, whether annual or monthly. However, we will not give any refund for termination related to conduct that we determine, in our discretion, violates these Terms or any applicable law, involves fraud or misuse of the Library membership, or is harmful to our interests or another user. It is clarified that if the Auto Renewal of your Library membership is enabled, you will be provided a refund (in accordance with these Terms) only for such membership term for which you have been charged. Our failure to insist upon or enforce your strict compliance with these Terms will not constitute a waiver of any of our rights.</p>
        <p><strong>Limitation of Liability</strong></p>
        <p>IN ADDITION TO OTHER LIMITATIONS AND EXCLUSIONS IN NETBOOKFLIX.COM&nbsp;<strong>CONDITIONS OF USE AND SALE</strong>&nbsp;, IN NO EVENT WILL WE OR OUR DIRECTORS, OFFICERS, EMPLOYEES, AGENTS OR OTHER REPRESENTATIVES BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, OR ANY OTHER DAMAGES OF ANY KIND, ARISING OUT OF OR RELATED TO LIBRARY. OUR TOTAL LIABILITY, WHETHER IN CONTRACT, WARRANTY, TORT (INCLUDING NEGLIGENCE) OR OTHERWISE, WILL NOT EXCEED THE LAST MEMBERSHIP FEE YOU PAID. THESE EXCLUSIONS AND LIMITATIONS OF LIABILITY WILL APPLY TO THE FULLEST EXTENT PERMITTED BY LAW AND WILL SURVIVE CANCELLATION OR TERMINATION OF YOUR LIBRARY MEMBERSHIP.</p>
        EOT;
        
        $contentPublisher = <<<EOT
       
        <p><strong><u>Publisher Partnership/Digital License Agreement</u></strong></p>
        <p>This Publisher partnership/Digital License Agreement (this&nbsp;"<strong>Agreement</strong>") contains the terms and conditions of (i) your use of the <strong>Netbookflix BOOK+ Digital Learning resource library and distribution program</strong> (the&nbsp;"<strong>Program</strong>") for distribution of e-books/class notes/videos/audio visual programs and related content via the platform services operated by Netbookflix or its Affiliates and (ii) Netbookflix use of such content.&nbsp;This Agreement is a binding agreement between you and Netbookflix. As used in this Agreement,&nbsp;"<strong>Netbookflix</strong>",&nbsp;"<strong>we</strong>"&nbsp;or&nbsp;"<strong>us</strong>"&nbsp;means, individually: (a) Netbookflix registered as private limited company as per Companies Act 1956, INDIA joins as a party to this Agreement as provided herein, in each case solely with respect to such entity's exercise of its rights and compliance with its obligations in connection with the countries, territories, and provinces designated by Netbookflix. As used in this Agreement,&nbsp;"Publisher&rdquo; or &ldquo;<strong>Content Provider</strong>"&nbsp;or&nbsp;"<strong>you</strong>"&nbsp;means the person or entity accepting this Agreement.&nbsp;"<strong>Affiliate</strong>"&nbsp;means any entity that directly or indirectly controls, is controlled by, or is under common control with Netbookflix or Content Provider, as appropriate.</p>
        <p>This Agreement expressly incorporates by reference other Program-specific terms and conditions governing the Program: the information posted on the Program Site, including the&nbsp;<u>Content Policy Guidelines</u>&nbsp;and&nbsp;<u>Direct Terms of Use</u>, as well as&nbsp;<u>Netbookflix.com Conditions of Use</u>&nbsp;and the&nbsp;<u>Netbookflix.com Privacy Notice</u>, located on Netbookflix.com (or the successor site thereto).</p>
        <p>In consideration of the mutual covenants contained herein and other good and valuable consideration, the receipt and sufficiency of which hereby are acknowledged, Content Provider and Netbookflix hereby agree as follows:</p>
        <table width="100%">
        <tbody>
        <tr>
        <td width="21%">
        <p><strong>Agreement Acceptance</strong></p>
        </td>
        <td width="78%">
        <p>You accept this Agreement by signing this agreement, where you are given the option to do so. If you do not accept the terms of this Agreement, you may not use the Program. By accepting this Agreement, you confirm that you are at least 18 years old (or the age of majority where you reside, whichever is older) and that you are able to form a legally binding contract. If you are accepting this Agreement on behalf of a company or other legal entity, you represent and warrant that you have the legal authority to bind that company or legal entity by the terms of this Agreement.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>1.</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Amendment; Notice of Changes</strong></p>
        </td>
        <td width="78%">
        <p>The Program will change over time and the terms of this Agreement will need to change over time as well. Subject to the provisions herein, we reserve the right to change the terms and conditions in this Agreement at any time in our sole discretion. Any changes to the Agreement, including Program-specific terms and conditions, or to the policies and guidelines referenced in this Agreement, other than with respect to the amount of the License Fees, will be effective upon posting of such revisions to the website for the Program at www.netbookflix.com (including any successor or replacement website, the&nbsp;"<strong>Program Site</strong>") and without prior notice to you. We will post a notice of any changes to this Agreement on the Program Site for at least thirty (30) days after the changes are effective. Changes to the License Fees will be effective and binding on you on the date 30 days from posting or on the date you accept the changes, whichever occurs first.</p>
        <p>&nbsp;</p>
        <p>Your continued use of the Program Site and the Program following any changes to this Agreement will constitute your acceptance of such changes. If you do not agree to changes to this Agreement or the Program Site, you should discontinue use. You are responsible for regularly reviewing the Program Site for changes and notice of any changes. Except as otherwise provided herein, changes to referenced policies and guidelines or any other information including, without limitation in the Content Policy Guidelines, Direct Terms of Use, Netbookflix.com Conditions of Use and the Netbookflix.com Privacy Notice may be posted without any other notice to you; provided, in the event of discrepancy between the terms of this Agreement and any of the foregoing, the terms of this Agreement shall prevail.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>2.</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Account Setup and Maintenance</strong></p>
        </td>
        <td width="78%">
        <p>You must ensure that all information you provide in connection with establishing your Program account is accurate when you provided it, and you must keep it up to date as long as you use the Program. You may maintain only one account at a time unless you are using multiple accounts solely for the purpose of delivery of Materials or making multiple subscriptions available via Netbookflix Subscription Access. You will not use false identities or impersonate any other person or use a username or password you are not authorized to use. You authorize us, directly or through third parties, to make any inquiries as appropriate to verify the account information you provide. You also consent to us sending you emails relating to the Program and other publishing opportunities from time to time.</p>
        <p><br />You are solely responsible for safeguarding and maintaining the confidentiality of your account username and password and are responsible for all activities that occur under your account, whether or not you have authorized the activities. You may not permit any third party to use the Program through your account and will not use the account of any third party. You agree to immediately notify Netbookflix of any unauthorized use of your username, password or account.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Term</strong></p>
        </td>
        <td width="78%">
        <p>This Agreement commences upon your acceptance of it and continues in perpetuity until terminated as set forth in this Agreement (the&nbsp;"<strong>Term</strong>"). All rights granted to Netbookflix herein shall not be deemed to have lapsed at any time in accordance with the applicable law of the Territory, including for the avoidance of doubt, as applicable, Section 19(4) read with Section 30-A of the Indian Copyright Act, 1957.</p>
        <p>&nbsp;</p>
        <p>We may terminate this Agreement by providing notice to you at any time. You may terminate this Agreement at any time by providing notice of termination to us, in which event we will cease offering your Titles within thirty (90) days from the date that we receive notice of termination; provided that if you distribute Titles via Netbookflix Subscription Access, (a) the Term of the Agreement with respect to Netbookflix Subscription Access will commence upon your acceptance of this Agreement and continue for eighteen (18) months from the date that your Subscription launches on the Service (the&nbsp;"<strong>Initial Subscription Term</strong>") and (b) the Initial Subscription Term will automatically extend for successive periods of twelve (12) months each unless and until terminated by either party by provision of notice of termination to the other party given not later than ninety (90) days prior to the conclusion of the then-current term.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>4.</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Territory</strong></p>
        </td>
        <td width="78%">
        <p>The territory, with respect to any Title, shall be each territory you indicate when prompted on the Program Site (the&nbsp;"<strong>Territory</strong>").</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>5.</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Rights Granted:</strong></p>
        </td>
        <td width="78%">
        <p>You hereby grant Netbookflix a non-exclusive license in the Territory to use, reproduce, reformat for online delivery, encode, encrypt, market, promote, transmit, distribute and display on the Service the e-books/videos/audio-visual programs ("<strong>Titles</strong>") pursuant to each Distribution Mode that you indicate on the Program Site; which in the case of Non-transactional Access will include access via free trials without any required payment of License Fees in connection therewith; provided, however, in the event that such free trials exceed a trial period for a given customer of 30 days per year, then Netbookflix will be obligated to pay you License Fees for such Non-transactional Access. As used herein, Title shall only refer to those e-books/videos/audio-visual programs editable and viewable in your Program account, as made available by you.</p>
        <p>&nbsp;</p>
        <p>"<strong>Service</strong>"&nbsp;means one or more e-books/class notes/audio/digital video services branded with a brand of Netbookflix or a Netbookflix Affiliate through which authorized users may obtain Titles via a Distribution Mode. As used in this Agreement, Titles refer solely to the e-books/class notes/audio-visual/video programs viewable and editable in your Program account and authorized for distribution on the Service. For the avoidance of doubt, the terms of this Agreement apply solely with respect to the Distribution Mode you have enabled for each such Title.</p>
        <p>&nbsp;</p>
        <p>Netbookflix will have the right, but not the obligation, to offer customers of the Service the opportunity to purchase or access the Titles pursuant to the Distribution Modes that you indicate as available on the Program Site. You will have an opportunity to provide a suggested retail price for your Titles that are made available for Digital Purchase, Digital Rental and Subscription Access but Netbookflix will have sole discretion to determine the retail prices charged for offerings on the Service.</p>
        <p>&nbsp;</p>
        <p>Netbookflix may advertise, market, and promote, in any and all media (whether now known or hereafter devised), the availability of Titles on the Service using the Delivery Materials and any images, trailers, logos, artwork, publicity materials, and metadata provided by you as it deems appropriate (including any non-substantial edits to such materials (e.g. cropping, re-sizing and re-formatting)) as well as any video clips from the Titles created by Netbookflix of up to (i) 1 consecutive minute of footage from Titles that are under 22 minutes in duration and (ii) 3 consecutive minutes of footage from Titles that are 22 minutes or longer in duration (collectively, the&nbsp;"<strong>Promotional Materials</strong>"). Netbookflix may insert advertisements before, during or after Titles made available in the Service for Ad-Supported Access and may insert pre-roll and post-roll advertisements, graphics, videos, and logos into or over Titles made available on the Service via any Distribution Modes. Netbookflix may feature the Promotional Materials in advertisements outside the Program Site, in any media, to promote the Titles and related products, the Service and any features of the Service, and the availability of the Titles on the Service.</p>
        <p>&nbsp;</p>
        <p>Netbookflix may make such modifications as may be necessary to conform the Title to applicable law in the Territory, provided Netbookflix will use commercially reasonable efforts to ensure such modifications do not to impair the creative integrity, quality or meaning of the Title.</p>
        <p>&nbsp;</p>
        <p>Notwithstanding any expiration or termination of this Agreement for any reason, Netbookflix may continue (including, after the conclusion of the Term) to exercise the rights granted hereunder in order to provide customers who purchased Titles via Digital Purchase or Digital Rental during the Term the ability to continue to access (including, without limitation, via re-download and streaming from the Service) and view the applicable Titles after the Term; provided, however, Netbookflix may not offer customers the opportunity to initiate new purchases or rentals of the Titles for Digital Purchase or Digital Rental after the Term.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>6.</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>General Description of the Service; Distribution Modes:</strong></p>
        </td>
        <td width="78%">
        <p>Content Provider, in its sole option, may allow customers to access Titles in the following ways:</p>
        <p>&nbsp;</p>
        <p>purchase a license to access digital copies of text/audio-visual content for electronic delivery and repeated viewing over an indefinite period of time ("<strong>Digital Purchase</strong>");</p>
        <p>&nbsp;</p>
        <p>purchase a license to access digital copies of text/audio-visual content for electronic delivery and repeated viewing over a finite period of time established by Netbookflix in its sole discretion ("<strong>Digital Rental</strong>");</p>
        <p>&nbsp;</p>
        <p>access text/audio visual content via one or more subscription offerings,&nbsp;where a fee is required to be paid for such access (other than in the case of a free trial),&nbsp;for repeated private viewing by subscribers during the Term ("<strong>Non-transactional Access</strong>"), which may be through (i) the subscription offering known as of the date hereof as Netbookflix, e-books, videos or any successor thereto ("<strong>Prime Subscription Access</strong>") or (ii) a subscription offering of your content as compiled by you or us which may or may not include content from other content providers ("<strong>Subscription Access</strong>"); and</p>
        <p>&nbsp;</p>
        <p>access text/audio visual content&nbsp;on an ad-supported basis (i.e., at no charge to the customer) for delivery and repeated private viewing during the Term ("<strong>Ad-supported Access</strong>").</p>
        <p>&nbsp;</p>
        <p>Digital Purchase, Digital Rental, Non-Transactional Access and Ad-supported Access are referred to herein as the&nbsp;"<strong>Distribution Modes</strong>".</p>
        <p>&nbsp;</p>
        <p>The Service&nbsp;may be offered on a stand-alone basis and/or bundled with other products, services, or offerings, including Netbookflix.&nbsp;As between the parties, Netbookflix will have sole control over the Service, all features, terms, and other aspects thereof (including, without limitation, the rights and entitlements granted to authorized users with respect to Digital Purchase, Digital Rental, Non-transactional Access and Ad-supported Access, the terms under which the Service is offered and the sale of advertisements in connection with the Service); provided, however, that Netbookflix distribution of Titles on the Service shall be in accordance with the terms of this Agreement.</p>
        <p>&nbsp;</p>
        <p>Without limiting the foregoing, you acknowledge that Netbookflix may (i) make the Service available through any websites, applications, device interfaces, third-party platforms and any other online platforms or points of presence now known or hereafter devised, (ii) grant authorized users who receive Digital Purchase, Digital Rental, Non-transactional Access and Ad-supported Access to text/audio-visual content the right to access such content via streaming, download, and any other means of digital distribution now known or hereafter devised, for online or offline viewing on any device supported by the Service, and (iii) deliver text/audio-visual content on the Service via any means now known or hereafter devised (including, without limitation, cable, wire, fiber, satellite, wireless and/or cellular).</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>7.</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>License Fee Payment</strong></p>
        </td>
        <td width="78%">
        <p>Subject to the limitations set forth in this Section, Netbookflix will pay you the applicable license fees set forth below ("<strong>License Fees</strong>") for each customer purchase of Titles for Digital Purchase or Digital Rental, and for offering customers&nbsp;Non-Transactional Access or Ad-supported Access. Such License Fees are the only compensation payable to you under this Agreement and constitute full and complete compensation to you for all rights granted under this Agreement.</p>
        <p>&nbsp;</p>
        <p>Netbookflix will calculate, report and pay the License Fees in arrears within ninety (60) days after the completion of the applicable calendar month. You will receive payment from Netbookflix via electronic funds transfer unless electronic funds transfer is not available for the address provided for your account, in which case you will receive payment by wire transfer. Notwithstanding anything to the contrary herein, if you receive payment via wire transfer, Netbookflix may withhold payment until you have reached the minimum threshold in accrued License Fees for the applicable local marketplace as set forth on the Program Site. You will also be responsible for any fees imposed by your bank or any intermediary bank. For the purposes of calculating License Fee payments, (i) the&nbsp;"<strong>Purchase Price</strong>"&nbsp;for a customer's right to access Titles via Digital Purchase, Digital Rental or Subscription Access will equal the amount actually paid by the authorized user for that access, exclusive of any taxes, and (ii) Netbookflix will be entitled to an adjustment for customer refunds and credits and for amounts not collected due to bad debt. If we pay you License Fees on a sale and later issue a refund, return, or credit for that sale, we may offset the amount of the License Fees that we previously paid to you for the sale against future License Fees, or require you to remit that amount to us.&nbsp; If a third party asserts that you did not have all rights required to make one of your Titles available through the Service or if we determine that you may be in breach of this Agreement, we may withhold all License Fees due to you with respect to such Title pending resolution of the issue. If we determine that you did not have all of the required rights or that you have otherwise breached this Agreement with regard to a Title, we will not owe you License Fees for that Title and we may offset any of the License Fees that were previously paid against future License Fees, or require you to remit a refund to us.&nbsp; We may also withhold and offset any sums you owe to us against amounts that are payable to you. When this Agreement terminates, we may withhold all License Fees due for a period of three months from the date they would otherwise be payable, in order to ensure our ability to offset any customer refunds or other offsets to which we are entitled.&nbsp; If we terminate your account because of your breach of this Agreement, you will forfeit any License Fees accrued but unpaid from the date of the notice of termination.&nbsp; If after we have terminated your account, you open a new account without our express permission, we will not owe you any License Fees through the new account. Our exercise of these rights does not limit other rights we may have to withhold or offset License Fees or exercise other remedies under applicable law.</p>
        <p>&nbsp;</p>
        <p>For clarity, Netbookflix will not be obligated to pay License Fees for Non-transactional Access in connection with the viewing of any Title by a customer if that customer was granted access to that Title via Digital Rental, Digital Purchase or Ad-supported Access, and similarly, Netbookflix will not be obligated to pay License Fees for Ad-supported Access in connection with the viewing of any Title by a customer if that customer was granted access to that Title via Digital Rental, Digital Purchase or Non-transactional Access.</p>
        <p>&nbsp;</p>
        <p>Netbookflix may sell your Titles using multiple currencies. You may elect on the Program Site to receive any License Fees owed to you (i) where applicable, in the local currency for the territory in which the distribution occurs (the&nbsp;"<strong>Sale Currency</strong>") or (ii) the currency of a single territory in which the Titles were distributed. If we pay you in a currency other than the Sale Currency, we will convert the License Fees owed from the Sale Currency to the payment currency at a market exchange rate that we or our bank determine, which will be inclusive of all fees and charges for the conversion.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>7.1</strong>&nbsp;<strong>Subscription Access License Fee</strong></p>
        </td>
        <td width="78%">
        <p>&nbsp;</p>
        <p>For Titles made available for Subscription Access, Netbookflix will pay you according to the rate card available below on a per title basis (for standalone titles and series), based on Hours Viewed by customers in the applicable Territory:</p>
        <p>&nbsp;</p>
        <p>"<strong>Hours Viewed</strong>"&nbsp;means the number of hours of a Title that is viewed by a viewer that is authorized by Netbookflix to view any Title via Subscription Access on the Service; provided that Hours Viewed will not include (and Netbookflix will not be obligated to pay for) (i) more than ten views/streams of the same Title by the same account in a given month or (ii) streams that Netbookflix determines, in its sole discretion, are not actual customer views (e.g., imitating legitimate views or click fraud) or are otherwise not authorized to access the Service.</p>
        <p>&nbsp;</p>
        <p>Hours will start accruing when the Title is viewed/streamed for the first time and will continue for a 365-day period.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p>7.2 &nbsp;<strong>Ad-supported Access License Fee</strong></p>
        </td>
        <td width="78%">
        <p>Netbookflix will pay you&nbsp;50% of Net Advertising Receipts.</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>"<strong>Net Advertising Receipts</strong>"&nbsp;means aggregate cash amounts collected by Netbookflix from the sale of advertisements against any Title for Ad-Supported Access during the quarter for which License Fees are being calculated,&nbsp;<u>less</u>&nbsp;15% of that aggregate cash amount (which is deemed to reflect the cost of selling advertisements) and&nbsp;<u>less</u>&nbsp;any payments made to any third-party advertising platforms or networks in connection with the distribution or sale of advertisements on those platforms or networks.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>8.</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Taxes</strong></p>
        </td>
        <td width="78%">
        <p>As between the Parties, Netbookflix will be solely responsible for collecting and paying to the appropriate taxing authorities any national, state or local sales or use taxes, value added taxes ("<strong>VAT</strong>") or similar taxes (collectively&nbsp;"<strong>Transaction Taxes</strong>") applicable to purchases by customers. Netbookflix will not be required to pay any taxes imposed on or measured by your net income, net profits, income, profits, revenues, gross receipts, franchise, doing business, capital, intangible, value added (other than value added tax in the nature of sales or use or similar taxes), net worth, all real property and ad valorem taxes imposed by any governmental authority on the fees payable to you under this Agreement, or similar taxes or taxes in lieu thereof, whether collected by withholding or otherwise.</p>
        <p>&nbsp;</p>
        <p>All payments payable by Netbookflix to you under this Agreement are inclusive of all Transaction Taxes that apply to the license of the Titles by you to Netbookflix, unless Netbookflix advises you otherwise. If and to the extent any payments hereunder are subject to and include any applicable Transaction Taxes, you will supply Netbookflix with an original, valid tax invoice, to the extent available under the applicable law, separately stating these Transaction Taxes, to enable Netbookflix to claim credit for these taxes as applicable. Netbookflix may provide you with an exemption certificate or equivalent information acceptable to the relevant taxing authority, in which case, you will not charge or collect the Taxes covered by such certificate. If taxes are required to be deducted or withheld on any payments to be made to you under applicable law, then Netbookflix will (i) deduct such taxes from the amount owed to you and pay them to the appropriate taxing authority as required by applicable law and (ii) secure and deliver to you a receipt or other legally required documentation for any taxes withheld as required under applicable laws.</p>
        <p>&nbsp;</p>
        <p>Payment to you as reduced by such deductions or withholdings will constitute full payment and settlement to you of amounts payable under this Agreement. Except as specified in this Section, each Party will be responsible for its own taxes as levied by the applicable taxing authorities; provided, any charges toward the stamp duty payable under the applicable laws shall be borne by you. Throughout the term of this Agreement, you will provide Netbookflix with any forms, documents or other certifications as may be required by Netbookflix to satisfy any information reporting or withholding tax obligations with respect to any payments under this Agreement.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>9.</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Delivery of Content:</strong></p>
        </td>
        <td width="78%">
        <p>For each Title, Content Provider, at its sole cost, will deliver to Netbookflix the Delivery Materials in accordance with such technical specifications as provided by Netbookflix to Content Provider (including, without limitation, the requirement that the Title not contain any advertisements, bugs, visible on-screen logos, or tracking tags).</p>
        <p>&nbsp;</p>
        <p>Content Provider authorizes Netbookflix to re-purpose and otherwise use in accordance with this Agreement (i) any Delivery Materials previously delivered to Netbookflix or its Affiliates by Content Provider or a third party, for purposes of exercising express and incidental rights granted hereunder with respect to the Titles and (ii) any Delivery Materials delivered by Content Provider under this Agreement, for purposes of Netbookflix exercising any rights granted to Netbookflix in respect of any Title under a subsequent agreement, solely to the extent authorized under any such subsequent agreement. Where any Delivery Materials have previously been delivered to Netbookflix by a third party, Content Provider will obtain any necessary clearances from such third party (if any) on behalf of Netbookflix and/or use its best efforts to assist Netbookflix in obtaining any such necessary clearances, to enable Netbookflix to use such previously delivered Delivery Materials. You will have no obligation to re-deliver Delivery Materials, except as necessary to comply with other obligations set forth pursuant to the terms of this Agreement.</p>
        <p>&nbsp;</p>
        <p>With respect to each Title, the&nbsp;"<strong>Delivery Materials</strong>"&nbsp;means (i) a copy of the Title at the highest resolution available to you, (ii) all Promotional Materials (including, but not limited to, all images, trailers, logos and artwork associated with the Title), (iii) captions and text/audio language files for the Title in accordance with Netbookflix technical specifications, but in any event, in accordance with applicable law for the Territory and Section 11 of this Agreement (iv) all metadata associated with the Title and (v) all available content ratings information, including rating and consumer advice, in accordance with applicable law for the Territory and Section 13 of the Agreement.</p>
        <p>&nbsp;</p>
        <p>You agree that the subscriptions made available to Netbookflix hereunder for distribution via Subscription Access comprised of Titles ("<strong>Subscriptions</strong>") will, at a minimum, be the same subscription text/videos on demand packages, including the same titles, as the subscription text/video on demand packages made available by you via any method of non-physical distribution.</p>
        <p>&nbsp;</p>
        <p>The Titles made available to Netbookflix hereunder for distribution via Digital Purchase or Digital Rental will, to the best of Content Provider&rsquo;s knowledge, include all text and audio-visual programs for which Content Provider has necessary rights to offer on a transactional text/audio/video on demand basis in the Territory but solely to the extent such Titles are also offered by Content Provider via any other non-physical distributor in the Territory; provided such Titles as licensed to Netbookflix shall have the same or better delivery dates as any other distributor in the Territory.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>10.</strong>&nbsp;&nbsp;<strong>Representations and Warranties</strong></p>
        </td>
        <td width="78%">
        <p>You hereby represent and warrant that (i) you have the sole, full and unencumbered right to grant to Netbookflix and its Affiliates, and have obtained all necessary clearances and releases to grant to Netbookflix and its Affiliates, all of the rights set forth herein (excluding public performance rights for the communication to the public of the on stage compositions contained within the Titles, such rights to be cleared by Netbookflix), (ii) any information and documentation you provide to us will be current, complete, and accurate (iii) the Delivery Materials and Promotional Materials will not contain any subject matter or materials that are defamatory, libelous, obscene, or otherwise illegal under the applicable laws of the Territory and (iv) none of the following will violate any law; require us to obtain any license, authorization, or other permission from any governmental agency or other third party; contain any defamatory material; or violate or infringe any intellectual property, proprietary, or other rights of any person or entity (including contractual rights, copyrights, trademarks, patents, trade dress, trade secret, common law rights, rights of publicity, or privacy, or moral rights): (a) the exercise of any rights granted under this Agreement; (b) any materials embodied in your Titles; (c) the sale, distribution, or promotion of the Titles as authorized in this Agreement; or (d) any notices, instructions or advertising by you for or in connection with any Titles.</p>
        <p>&nbsp;</p>
        <p>You further represents and warrants that you are not subject to sanctions or designated on any list of prohibited or restricted parties (and is not owned or controlled by such a party), including but not limited to the lists maintained by the National Governments, United Nations Security Council, the US Government, the European Union or its member states, or other applicable government authority.</p>
        <p>&nbsp;</p>
        <p>You acknowledge that Netbookflix Code of Business Conduct and Ethics (the&nbsp;"<strong>Code</strong>") prohibits the paying of bribes to anyone for any reason, whether in dealings with governments or the private sector. You will not violate or knowingly permit anyone to violate the Code's prohibition on bribery or any applicable anti-corruption laws in performing under this Agreement. Netbookflix may immediately terminate or suspend performance under this Agreement if you breach this requirement.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>11.</strong>&nbsp;&nbsp;<strong>Closed Captions; Subtitles</strong></p>
        </td>
        <td width="78%">
        <p>You will deliver closed captions for all Titles in accordance with Netbookflix technical specifications as provided on the Program Site, but in any event, in accordance with applicable law for the Territory. You may not be able to publish a Title via one or more Distribution Modes in certain Territories until Netbookflix has received closed captions from you.</p>
        <p>&nbsp;</p>
        <p>You will deliver English language versions of the Titles, unless the original version of a Title is not in English, in which case you will deliver (i) either audio descriptions, subtitles or dubbed language tracks and (ii) the title and synopsis information for the Title, in each case, in at least one core language identified by Netbookflix for the Territory.</p>
        <p>&nbsp;</p>
        <p>Further to the rights granted hereunder, Netbookflix may create, insert and distribute closed captions, audio descriptions, dubbed language tracks and subtitles for Titles in any language for which Content Provider is able to grant the necessary rights in the Territory and may use or distribute any such closed caption, dubbed language track, subtitle file or audio description it creates in any such Territory.&nbsp;In connection with such creation, Netbookflix will use reasonable commercial efforts to ensure that such closed caption and subtitled versions reflect the original version of the Licensed Title.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>12.</strong>&nbsp;&nbsp;<strong>Geo-filtering; Access Controls:</strong></p>
        </td>
        <td width="78%">
        <p>Netbookflix will utilize industry standard geo-filtering techniques and digital rights management technology in a non-discriminatory manner in relation to similarly situated content providers. Content Provider agrees that Netbookflix shall be deemed to be exercising the rights granted herein solely within the Territory as long as Netbookflix complies with the foregoing. Content Provider acknowledges that Netbookflix makes no representation as to the efficacy of any geo filtering technique or digital rights management technology it employs and agrees that Netbookflix shall not be responsible for the failure of such.</p>
        <p>Content Provider acknowledges and agrees that: (i)&nbsp;Content Provider's ability to suspend distribution of Titles on the Service shall be Content Provider's sole and exclusive right and remedy, and Netbookflix sole and exclusive obligation, for any circumvention or failure of any geo filtering techniques or digital rights management technology used by Netbookflix on the Service for Titles and (ii)&nbsp;Content Provider shall not be entitled to any other remedies, including without limitation monetary damages, in connection therewith.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>13.</strong>&nbsp;&nbsp;<strong>Content Requirements</strong></p>
        </td>
        <td width="78%">
        <p>You must ensure that all of your Titles and Subscriptions are in compliance with our policies for content at the time you submit them to us. If you discover that content you have submitted does not comply, you must immediately withdraw the content and otherwise bring such Title or Subscription into compliance if it is to be distributed via the Service. If you discover that any information you have provided to us for a Title or Subscription is inaccurate or incomplete, you must promptly submit corrected information to us. We will determine what content we accept and distribute on the Service in our sole discretion.</p>
        <p>&nbsp;</p>
        <p>If we request that you provide additional information relating to your Titles or Subscription, such as information confirming that you have all rights required to permit our distribution of the Titles or Subscription, you will promptly provide the information requested, recognizing that your content may not be made available for distribution until proof of rights is received. You authorize us, directly or through third parties, to make any inquiries we consider appropriate to verify your rights to permit our distribution of the Titles or Subscription and the accuracy of the information or documentation you provide to us with respect to those rights.</p>
        <p>&nbsp;</p>
        <p>We may remove or modify the Titles, the Subscriptions, the metadata, cover art and product description you provide for your Titles and Subscriptions for any reason, including if we determine that it does not comply with Netbookflix content policy guidelines. We will promptly notify you of any such removal of a Title or Subscription. You may not include any advertisements or other content that is primarily intended to advertise or promote products or services.</p>
        <p>&nbsp;</p>
        <p>You agree to provide local content ratings in each country/region in which you distribute your Titles from the applicable local ratings authorities where requested by us. Nothing herein shall restrict Netbookflix from, at its sole cost, obtaining ratings information for the Titles in any country within the Territory or generating its own ratings for the Titles.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>14.</strong>&nbsp;&nbsp;<strong>Title Withdrawal</strong></p>
        </td>
        <td width="78%">
        <p>You may withdraw your Titles from availability on the Service at any time on thirty (90) business days advance notice by following the then current Program procedures for Title withdrawal or un-publishing; provided that you may not remove a Title within a Subscription unless you either (i)&nbsp;lose any rights or other licenses, consents or permissions relating to any specific Title that are necessary for you to grant the rights granted hereunder or (ii)&nbsp;receive written notice of a third-party claim relating to a Title, which reasonably could result in legal liability for you; provided that Netbookflix will only be obligated to withdraw the Title from a Subscription if you also concurrently obligate other subscription based services to withdraw the Title.</p>
        <p>&nbsp;</p>
        <p>We may fulfil any customer orders completed through the date the Titles are available on the Service. All withdrawals of Titles and Subscriptions will apply prospectively only and not with respect to any customers who purchased the Titles or Subscriptions prior to the date of removal, meaning that we will allow any customer who has previously purchased a Title for Digital Purchase or Digital Rental or a Subscription for Access to view the Title or Subscription, as applicable, after it has been withdrawn from the Service to the extent that such customer purchased those rights prior to the withdrawal.</p>
        </td>
        </tr>
        <tr>
        <td width="21%">
        <p><strong>15.</strong>&nbsp;&nbsp;<strong>Ownership; Feedback</strong></p>
        </td>
        <td width="78%">
        <p>Subject to the rights you grant to us under this Agreement, as between us and you, you retain all ownership rights in and to the copyrights and all other rights and interest in and to your Titles and Subscriptions. We retain all ownership rights in and to the copyrights and all other rights and interests in and to the Program, the Program Site and all Netbookflix properties, and any materials we use or provide to you for use relating to your Titles and Subscriptions (such as a generic cover image used for your Titles or Subscriptions if you do not provide one). We are solely responsible for, and will have full discretion with respect to the terms, features, and operation of the Program and the Program Site and related marketing, but our use of the Titles, Promotional Materials and Subscriptions will be subject to the terms of this Agreement. If you elect to provide suggestions, ideas, or other feedback to Netbookflix or any of its Affiliates in connection with the Service, the Program, the Program Site or anything on the Program Site ("<strong>Feedback</strong>"), Netbookflix and its Affiliates will be free to use and exploit the same in any manner without restriction and without any need to compensate you. This Agreement does not grant you any license or other rights to any intellectual property or technology owned or operated by us or any of our Affiliates, including, without limitation, any trademarks or trade names.&nbsp;You agree not to use any trade name, trademark, service mark, logo or commercial symbol, or any other proprietary rights of Netbookflix or any of its affiliates in any manner without prior written authorization.<em>&nbsp;</em>Nothing in this Agreement restricts any rights we may have under applicable law or a separate agreement.</p>
        </td>
        </tr>
        </tbody>
        </table>
        <p>&nbsp;</p>
        <ol start="16">
        <li><strong>Termination of Agreement</strong>. If either party is in breach of this Agreement and fails to cure such breach within 90 days following written notice from the other party, the non-breaching party may terminate this Agreement upon 5 business days&rsquo; written notice to the breaching party. Following any termination or expiration of this Agreement, any provision which, by its nature or express terms should survive will survive such termination or expiration, including, but not limited to, Sections 16 through 20.</li>
        </ol>
        <p>&nbsp;</p>
        <ol start="17">
        <li><strong>Indemnification</strong>.&nbsp;You will indemnify, defend and hold harmless Netbookflix, its officers, directors, employees, shareholders, affiliates, subcontractors, successors and assignees, from and against any and all third-party claims, actions, causes of action, demands, judgments, liabilities, damages, losses, injuries, costs and expenses (including, without limitation, reasonable attorneys&rsquo; fees and court costs) brought against Netbookflix that arise from or relate to: (a) any breach or alleged breach by you of any of your representations, warranties or obligations set forth herein, including any failure to deliver text/closed captions, audio descriptions or ratings information for any Titles in compliance with applicable law; or (b) any claim that Netbookflix exercise of the rights granted by you under this Agreement violates any law or regulation or the right(s) of any third party (individually, a&nbsp;"<strong>Claim</strong>",&nbsp;and collectively, the&nbsp;"<strong>Claims</strong>").&nbsp;You will not consent to the entry of a judgment or settle a Claim without our prior written consent, which may not be unreasonably withheld. You will use counsel reasonably satisfactory to us to defend each Claim. If we reasonably determine that a Claim might adversely affect us.</li>
        </ol>
        <p>&nbsp;</p>
        <ol start="18">
        <li><u>Limitation of Liability</u>.&nbsp;NETBOOKFLIX WILL NOT BE LIABLE TO THE CONTENT PROVIDER FOR ANY LOST PROFITS OR CONSEQUENTIAL, INDIRECT, INCIDENTAL, PUNITIVE, EXEMPLARY OR SPECIAL DAMAGES ARISING OUT OF OR IN ANY WAY RELATED TO THIS AGREEMENT, EVEN IF NETBOOKFLIX HAS BEEN ADVISED OR IS AWARE OF THE POSSIBILITY OF SUCH DAMAGES.&nbsp;NETBOOKFLIX WILL NOT BE LIABLE TO CONTENT PROVIDER FOR DAMAGES ARISING OUT OF OR IN ANY WAY RELATED TO THIS AGREEMENT, WHETHER IN CONTRACT, WARRANTY, TORT (INCLUDING NEGLIGENCE OR OTHER THEORY) OR OTHERWISE, FOR AN AGGREGATE AMOUNT IN EXCESS OF&nbsp;THE AMOUNT OF FEES DUE AND PAYABLE BY NETBOOKFLIX UNDER THIS AGREEMENT FOR THE TWELVE-MONTH PERIOD PRECEDING THE CLAIM. NOTWITHSTANDING THE FOREGOING, THIS SECTION WILL NOT BE DEEMED TO WAIVE ANY OF CONTENT PROVIDER'S RIGHTS AT LAW OR IN EQUITY TO ENFORCE THIS AGREEMENT WITH RESPECT TO UNDISPUTED LICENSE FEE PAYMENTS DUE TO CONTENT PROVIDER BY NETBOOKFLIX HEREUNDER. THE SERVICE IS MADE AVAILABLE ON AN AS IS BASIS AND NETBOOKFLIX MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, REGARDING THE SERVICE, INCLUDING WITHOUT LIMITATION, (I) THAT THE SERVICE WILL ALWAYS BE AVAILABLE, ACCESSIBLE, OR OPERATE WITHOUT ERROR OR (II) AS TO THE VOLUME OF SALES OR LICENSE FEES THAT WILL BE GENERATED BY TITLES CONTENT ON THE SERVICE.&nbsp;TO THE EXTENT REQUIRED BY LAW IN THE RELEVANT JURISDICTION OF THE PARTIES, THE PARTIES DO NOT EXCLUDE OR LIMIT LIABILITY FOR DEATH OR PERSONAL INJURY, FRAUDULENT MISREPRESENTATION OR ANY OTHER LIABILITY THAT CANNOT BE EXCLUDED BY SUCH APPLICABLE LAW.</li>
        </ol>
        <p>&nbsp;</p>
        <ol start="19">
        <li><strong>Confidentiality</strong>. You will not, without our express, prior written permission: (a) issue any press release, media pitch or make any other public disclosures regarding this Agreement or its terms; (b) disclose Netbookflix Confidential Information (as defined below) to any third party or to any employee other than an employee who needs to know the information; or (c) use Netbookflix Confidential Information for any purpose other than the performance of this Agreement. You may however disclose Netbookflix Confidential Information as required to comply with applicable law, provided you: (i) give us prior written notice sufficient to allow us to seek a protective order or other appropriate remedy; (ii) disclose only that Netbookflix Confidential Information as is required by applicable law; and (iii) use reasonable efforts to obtain confidential treatment for any Netbookflix Confidential Information so disclosed. "Netbookflix Confidential Information" means (1) any information regarding Netbookflix, its affiliates, and their businesses, including, without limitation, information relating to our technology, customers, business plans, promotional and marketing activities, finances and other business affairs, (2) the nature, content and existence of any communications between you and us, and (3) any sales data relating to the sale of digital videos or other information we provide or make available to you in connection with the Program. Netbookflix Confidential Information does not include information that (A) is or becomes publicly available without breach of this Agreement, (B) you can show by documentation to have been known to you at the time you receive it from us, (C) you receive from a third party who did not acquire or disclose such information by a wrongful or tortious act, or (D) you can show by documentation that you have independently developed without reference to any Netbookflix Confidential Information. Without limiting the survivability of any other provision of this Agreement, this Section will survive three years following the termination of this Agreement.</li>
        </ol>
        <p>&nbsp;</p>
        <ol start="20">
        <li><strong>Miscellaneous</strong>. All rights granted to Netbookflix under this Agreement may be exercised by Netbookflix, its Affiliates, and subcontractors providing services in connection with the Service. Any Netbookflix Affiliate may join as a party to this Agreement and will notify you if it does so. The joining Netbookflix Affiliate will be entitled to exercise the rights that you grant under this Agreement. Each Netbookflix party is severally liable for its own obligations under this Agreement and is not jointly liable for the obligations of other Netbookflix parties. In addition, each Netbookflix party is solely responsible with respect to its exercise of its rights and compliance with its obligations in connection with the territory or territories for which it is responsible, as determined by Netbookflix in its sole discretion. You may not assign any of your rights or obligations under this Agreement without the prior written consent of Netbookflix. A waiver by either party of any breach or default by the other party under this Agreement will not constitute a waiver of any other or subsequent breach or default by such other party. The failure of either party to enforce any term of this Agreement will not constitute a waiver of such party's rights to subsequently enforce the term. The remedies specified in this Agreement are in addition to any other remedies that may be available at law or in equity. For the purposes of this Agreement, Netbookflix and you are independent contracting parties, and nothing herein will be construed as creating an agency relationship, a fiduciary relationship, an employer-employee relationship, a partnership, a joint venture, or an obligation to form any such relationship or entity between Netbookflix and you. You will not represent yourself to be an employee, representative, or agent of Netbookflix or misrepresent the nature of your affiliation with Netbookflix or the Program Site. You will have no authority to enter into any agreement on Netbookflix behalf or in Netbookflix name or otherwise bind Netbookflix to any agreement or obligation.</li>
        </ol>
        <p>&nbsp;</p>
        <p><strong>Any dispute or claim arising from or relating to this Agreement or the Program is subject to the binding arbitration, governing law, disclaimer of warranties and limitation of liability and all other terms in the&nbsp;</strong><strong><u>Netbookflix.com Conditions of Use</u></strong><strong>.</strong>&nbsp;<strong>You agree to those terms by entering into this Agreement or using the Program.</strong>&nbsp;<strong>The Indian Arbitration &amp; conciliation Act,1996, applicable Indian law, and without regard to principles of conflict of laws, will govern this Agreement and any dispute of any sort that might arise between you and Netbookflix relating to this Agreement or the Program.</strong></p>
        <p>&nbsp;</p>
        <p>To be effective, except where specified otherwise in this Agreement, any notice hereunder by either party must be in writing and delivered (i) if by Netbookflix, via email using the email address provided in your Program account, posting on the Program Site or message through your Program account or (ii) if by you, via email to&nbsp;<u>support@Netbookflix.com</u>. Notices will be effective and deemed received on the date transmitted or posted. This Agreement constitutes the complete and final agreement of the parties pertaining to the subject matter of this Agreement and supersede the parties&rsquo; prior agreements, understandings, and discussions related to the subject matter of this Agreement. If any term of this Agreement is held to be invalid, void or unenforceable, then the remaining terms of this Agreement will be unaffected and will be valid and enforceable to the fullest extent permitted by law. Nothing in this Agreement will restrict Netbookflix from exercising any right it has pursuant to another applicable permission or would have at law in the absence of this Agreement.</p>
        <p>&nbsp;</p>
        <p><strong>IN WITNESS WHEREOF, THE PARTIES HERE TO HAVE EXECUTED THIS AGREEMENT ON THE DATE FIRST ABOVE WRITTEN</strong></p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>

        EOT;

        $contentConditionOfUse = <<<EOT
        
        <h1>Conditions of Use</h1>
          <p><strong>Last updated: July 17, 2020</strong></p>
          <p>Welcome to Netbookflix.com provide website features and other products and services to you when you visit or shop at Netbookflix.com, use Netbookflix products or services, use Netbookflix applications for mobile, or use software provided by Netbookflix in connection with any of the foregoing (collectively, "Netbookflix Services"). Netbookflix provides the Netbookflix Library Services subject to the following conditions.</p>
          <h2>By using Netbookflix Library Services, you agree to these conditions. Please read them carefully.</h2>
          <p>We offer a wide range of Netbookflix Library Services, and sometimes additional terms may apply. When you use an Netbookflix Library Service (for example, Your Profile, Video, Your Media Library, Netbookflix devices, or&nbsp;Netbookflix Applications) you also will be subject to the guidelines, terms and agreements applicable to that Netbookflix Service ("Service Terms"). If these Conditions of Use are inconsistent with the Service Terms, those Service Terms will control.</p>
          <h2>PRIVACY</h2>
          <p>Please review our&nbsp;Privacy Notice, which also governs your use of Netbookflix Services, to understand our practices.</p>
          <h2>ELECTRONIC COMMUNICATIONS</h2>
          <p>When you use Netbookflix Library Services, or send e-mails, text messages, and other communications from your desktop or mobile device to us, you may be communicating with us electronically. You consent to receive communications from us electronically, such as e-mails, texts, mobile push notices, or notices and messages on this site or through the other Netbookflix Services, such as our Message Center, and you can retain copies of these communications for your records. You agree that all agreements, notices, disclosures, and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing.</p>
          <h2>COPYRIGHT</h2>
          <p>All content included in or made available through any Netbookflix Service, such as text, graphics, logos, button icons, images, audio clips, digital downloads, data compilations, and software is the property of Netbookflix or its content suppliers and protected by Indian and international copyright laws. The compilation of all content included in or made available through any Netbookflix Service is the exclusive property of Netbookflix and protected by Indian and international copyright laws.</p>
          <h2>TRADEMARKS</h2>
          <p>In addition, graphics, logos, page headers, button icons, scripts, and service names included in or made available through any Netbookflix Service are trademarks or trade dress of Netbookflix in the India and other countries. Netbookflix trademarks and trade dress may not be used in connection with any product or service that is not Netbookflix, in any manner that is likely to cause confusion among customers, or in any manner that disparages or discredits Netbookflix. All other trademarks not owned by Netbookflix that appear in any Netbook Service are the property of their respective owners, who may or may not be affiliated with, connected to, or sponsored by Netbookflix.</p>
          <h2>PATENTS</h2>
          <p>One or more patents owned by Netbookflix apply to the Netbookflix Services and to the features and services accessible via the Netbookflix Services. Portions of the Netbookflix Library Services operate under license of one or more patents.&nbsp;</p>
          <h2>LICENSE AND ACCESS</h2>
          <p>Subject to your compliance with these Conditions of Use and any Service Terms, and your payment of any applicable fees, Netbookflix or its content providers grant you a limited, non-exclusive, non-transferable, non-sublicensable license to access and make personal and non-commercial use of the Netbookflix Library Services. This license does not include any resale or commercial use of any Netbookflix Service, or its contents; any collection and use of any product listings, descriptions, or prices; any derivative use of any Netbookflix Service or its contents; any downloading, copying, or other use of account information for the benefit of any third party; or any use of data mining, robots, or similar data gathering and extraction tools. All rights not expressly granted to you in these Conditions of Use or any Service Terms are reserved and retained by Netbookflix or its licensors, suppliers, publishers, rightsholders, or other content providers. No Netbookflix Service, nor any part of any Netbookflix Service, may be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without express written consent of Netbookflix. You may not frame or utilize framing techniques to enclose any trademark, logo, or other proprietary information (including images, text, page layout, or form) of Netbookflix without express written consent. You may not use any meta tags or any other "hidden text" utilizing Netbookflix name or trademarks without the express written consent of Netbookflix. You may not misuse the Netbookflix library Services. You may use the Netbookflix Services only as permitted by law. The licenses granted by Netbookflix terminate if you do not comply with these Conditions of Use or any Service Terms.</p>
          <h2>YOUR ACCOUNT</h2>
          <p>You may need your own Netbookflix account to use certain Netbookflix Library Services, and you may be required to be logged in to the account and have a valid payment method associated with it. If there is a problem charging your selected payment method, we may charge any other valid payment method associated with your account. Visit <a href="https://www.netbookflix.com">https://www.netbookflix.com</a> to manage your payment options. You are responsible for maintaining the confidentiality of your account and password and for restricting access to your account, and you agree to accept responsibility for all activities that occur under your account or password. Netbookflix does sell products for children, but it sells them to adults, who can purchase with a credit card or other permitted payment method. If you are under 18, you may use the Netbookflix Library Services only with involvement of a parent or guardian. Parents and guardians may create profiles for teenagers in their Netbookflix Household. You must be at least 21 years of age to use any site functionality related to such books. Netbookflix reserves the right to refuse service, terminate accounts, terminate your rights to use Netbookflix Library Services, remove or edit content, or cancel orders in its sole discretion.</p>
          <h2>REVIEWS, COMMENTS, COMMUNICATIONS, AND OTHER CONTENT</h2>
          <p>You may post reviews, comments, photos, videos, and other content; send e-cards and other communications; and submit suggestions, ideas, comments, questions, or other information, so long as the content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights (including publicity rights), or otherwise injurious to third parties or objectionable, and does not consist of or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings, or any form of "spam" or unsolicited commercial electronic messages. You may not use a false e-mail address, impersonate any person or entity, or otherwise mislead as to the origin of a card or other content. Netbookflix reserves the right (but not the obligation) to remove or edit such content, but does not regularly review posted content.</p>
          <p>If you do post content or submit material, and unless we indicate otherwise, you grant Netbookflix a nonexclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, perform, translate, create derivative works from, distribute, and display such content throughout the world in any media. You grant Netbookflix and sublicensees the right to use the name that you submit in connection with such content, if they choose. You represent and warrant that you own or otherwise control all of the rights to the content that you post; that the content is accurate; that use of the content you supply does not violate this policy and will not cause injury to any person or entity; and that you will indemnify Netbookflix for all claims resulting from content you supply. Netbookflix has the right but not the obligation to monitor and edit or remove any activity or content. Netbookflix takes no responsibility and assumes no liability for any content posted by you or any third party.</p>
          <h2>INTELLECTUAL PROPERTY COMPLAINTS</h2>
          <p>Netbookflix respects the intellectual property of others. If you believe that your intellectual property rights are being infringed, please follow our&nbsp;<strong>Notice and Procedure for Making Claims of Copyright Infringement</strong><strong>.</strong></p>
          <h2>&nbsp;</h2>
          <h2>RISK OF LOSS</h2>
          <p>All purchases of physical items from Netbookflix are made pursuant to a shipment contract. This means that the risk of loss and title for such items pass to you upon our delivery to the carrier.</p>
          <h2>PRODUCT DESCRIPTIONS</h2>
          <p>Netbookflix attempts to be as accurate as possible. However, Netbookflix does not warrant that product descriptions or other content of any Netbookflix Service is accurate, complete, reliable, current, or error-free. If a product offered by Netbookflix itself is not as described, your sole remedy is to return it in unused condition.</p>
          <h2>APP PERMISSIONS</h2>
          <p>When you use apps created by Netbookflix, such as the Netbookflix App, you may grant certain permissions to us for your device. Most mobile devices provide you with information about these permissions. &nbsp;</p>
          <h2>RESTRICTIONS AND EXPORT POLICY</h2>
          <p>You may not use any Netbookflix Service if you are the subject of Indian government sanctions or of sanctions consistent with Indian law imposed by the governments of the country where you are using Netbookflix Services. You must comply with all Indian or other export and re-export restrictions that may apply to goods, software (including Netbookflix Software), technology, and services.</p>
          <h2>OTHER BUSINESSES</h2>
          <p>Parties other than Netbookflix operate e-stores, provide services or software, or sell product lines through the Netbookflix Library Services. In addition, we provide links to the sites of affiliated companies and certain other businesses. If you purchase any of the products or services offered by these businesses or individuals, you are purchasing directly from those third parties, not from Netbookflix. We are not responsible for examining or evaluating, and we do not warrant, the offerings of any of these businesses or individuals (including the content of their Web sites). Netbookflix does not assume any responsibility or liability for the actions, product, and content of all these and any other third parties. You should carefully review their privacy statements and other conditions of use.</p>
          <h2>DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h2>
          <p>THE NETBOOKFLIX LIBRARY SERVICES AND ALL INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) AND OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE NETBOOKFLIX SERVICES ARE PROVIDED BY NETBOOKFLIX ON AN "AS IS" AND "AS AVAILABLE" BASIS, UNLESS OTHERWISE SPECIFIED IN WRITING. NETBOOKFLIX MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THE NETBOOKFLIX SERVICES, OR THE INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) OR OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE NETBOOKFLIX SERVICES, UNLESS OTHERWISE SPECIFIED IN WRITING. YOU EXPRESSLY AGREE THAT YOUR USE OF THE NETBOOKFLIX SERVICES IS AT YOUR SOLE RISK.</p>
          <p>TO THE FULL EXTENT PERMISSIBLE BY LAW, NETBOOKFLIX DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. AMAZON DOES NOT WARRANT THAT THE NETBOOKFLIX SERVICES, INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) OR OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE NETBOOKFLIX SERVICES, NETBOOKFLIX SERVERS OR ELECTRONIC COMMUNICATIONS SENT FROM NETBOOKFLIX ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. TO THE FULL EXTENT PERMISSIBLE BY LAW, NETBOOKFLIX WILL NOT BE LIABLE FOR ANY DAMAGES OF ANY KIND ARISING FROM THE USE OF ANY NETBOOKFLIX SERVICE, OR FROM ANY INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) OR OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH ANY NETBOOKFLIX SERVICE, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES, UNLESS OTHERWISE SPECIFIED IN WRITING.</p>
          <h2>&nbsp;</h2>
          <h2>DISPUTES</h2>
          <p><strong>Any dispute or claim relating in any way to your use of any Netbookflix Service, or to any products or services sold or distributed by Netbookflix or through Netbookflix.com will be resolved by binding arbitration, rather than in court</strong>, except that you may assert claims in small claims court if your claims qualify. The Indian Arbitration Act and Indian arbitration law apply to this agreement.</p>
          <p><strong>There is no judge or jury in arbitration, and court review of an arbitration award is limited. However, an arbitrator can award on an individual basis the same damages and relief as a court (including injunctive and declaratory relief or statutory damages), and must follow the terms of these Conditions of Use as a court would.</strong></p>
          <p>To begin an arbitration proceeding, you must send a letter requesting arbitration and describing your claim to our registered agent. The arbitration will be conducted by the Indian council of Arbitration (ICA) under its rules, including the ICA's Supplementary Procedures for Consumer-Related Disputes.&nbsp; Payment of all filing, administration and arbitrator fees will be governed by the ICA's rules. We will reimburse those fees for claims totaling less than INR 1000 unless the arbitrator determines the claims are frivolous. Likewise, Netbookflix will not seek attorneys' fees and costs in arbitration unless the arbitrator determines the claims are frivolous. You may choose to have the arbitration conducted by telephone, based on written submissions, or in person in the county where you live or at another mutually agreed location.</p>
          <p><strong>We each agree that any dispute resolution proceedings will be conducted only on an individual basis and not in a class, consolidated or representative action.</strong>&nbsp;If for any reason a claim proceeds in court rather than in arbitration&nbsp;<strong>we each waive any right to a jury trial</strong>. We also both agree that you or we may bring suit in court to enjoin infringement or other misuse of intellectual property rights.</p>
          <h2>APPLICABLE LAW</h2>
          <p>By using any Netbookflix Service, you agree that the Indian Arbitration Act, applicable law, and the laws of the Indian state, without regard to principles of conflict of laws, will govern these Conditions of Use and any dispute of any sort that might arise between you and Netbookflix.</p>
          <h2>SITE POLICIES, MODIFICATION, AND SEVERABILITY</h2>
          <p>Please review our other policies, such as our&nbsp;<strong>pricing policy</strong> posted on this site. These policies also govern your use of Netbookflix Services. We reserve the right to make changes to our site, policies, Service Terms, and these Conditions of Use at any time. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.</p>
          <h2>OUR ADDRESS</h2>
          <p>Netbookflix Learning Resource Pvt. Ltd.C-2, Sector-1, Noida-201301<a href="http://www.netbookflix.com">www.netbookflix.com</a> &nbsp;</p>
          <h2>ADDITIONAL NETBOOKFLIX SOFTWARE TERMS</h2>
          <p>The following terms (&ldquo;Software Terms&rdquo;) apply to any software (including any updates or upgrades to the software) and any related documentation we make available to you in connection with Netbookflix Services (the "Netbookflix Software").</p>
          <ol>
          <li><strong>Use of the Netbookflix Software.</strong>You may use Netbookflix Software solely for purposes of enabling you to use the Netbookflix Library Services as provided by Netbookflix, and as permitted by these Conditions of Use and any Service Terms. You may not incorporate any portion of the Netbookflix Software into other programs or compile any portion of it in combination with other programs, or otherwise copy (except to exercise rights granted in this section), modify, create derivative works of, distribute, assign any rights to, or license the Netbookflix Software in whole or in part. All software used in any Netbookflix Service is the property of Netbookflix or its software suppliers and is protected by Indian States and international copyright laws.</li>
          <li><strong>Use of Third-Party Services.</strong>When you use the Netbookflix Software, you may also be using the services of one or more third parties, such as a wireless carrier or a mobile software provider. Your use of these third-party services may be subject to the separate policies, terms of use, and fees of these third parties.</li>
          <li><strong>No Reverse Engineering.</strong>You may not reverse engineer, decompile or disassemble, tamper with, or bypass any security associated with the Netbookflix Software, whether in whole or in part.</li>
          <li>We may offer automatic or manual updates to the Netbookflix Software at any time and without notice to you.</li>
          <li><strong>Government End Users.</strong>If you are a Indian Government end user, we are licensing the Netbookflix Software to you as a "Commercial Item" as that term is defined in the applicable Indian Law, and the rights we grant you to the Netbookflix Software are the same as the rights we grant to all others under these Conditions of Use.</li>
          <li>In the event of any conflict between these Conditions of Use and any other Netbookflix or third-party terms applicable to any portion of Netbookflix Software, such as open-source license terms, such other terms will control as to that portion of 0the Netbookflix Software and to the extent of the conflict.</li>
          </ol>
          <p>&nbsp;</p>
          <h2>NOTICE AND PROCEDURE FOR MAKING CLAIMS OF INTELLECTUAL PROPERTY INFRINGEMENT</h2>
          <p>If you believe that your intellectual property rights have been infringed, please submit your complaint using our online&nbsp;form. This form may be used to report all types of intellectual property claims including, but not limited to, copyright, trademark, and patent claims.</p>
          <p>We respond quickly to the concerns of rights owners about any alleged infringement, and we terminate repeat infringers in appropriate circumstances.</p>
          <h2>Content policy guidelines</h2>
          <p>Your books/class notes, videos and other content (such as cover image and product descriptions) must adhere to these content policy guidelines, which may change over time. We reserve the right to make judgments about whether content is appropriate, including the appropriateness of suggested content ratings for a given title. In an effort to provide the best customer experience, we may choose not to offer your content or otherwise restrict its availability. We may also terminate your participation in the Prime Video Direct program if you don't adhere to these content policy guidelines. If after we have suspended or terminated your account, you submit the same or similar content through a separate account, we reserve the right to terminate that account. If after we have terminated your account, you open a new account without our express permission, we will not owe you any License Fees through the new account.</p>
          <h3>Offensive Content</h3>
          <p>We reserve the right to determine the appropriateness of all content submitted for publication on the service. Titles containing persistent or graphic sexually explicit or violent acts, gratuitous nudity, and/or erotic themes ("adult content") are not eligible for inclusion in the catalogue.</p>
          <h3>Illegal and Infringing Content</h3>
          <p>We take violations of laws and proprietary rights very seriously. It is your responsibility to ensure that your content doesn't violate applicable laws or copyright, trademark, privacy, publicity, or other rights (including with respect to components of your content such as the background music or items displayed within your content). Just because content is freely available does not mean you are free to copy and sell it.</p>
          <h3>Poor Customer Experience</h3>
          <p>We don't accept content that contain external links, tracking tags, functionality which is unsupported by Netbookflix platform, or which otherwise provide a poor customer experience. We reserve the right to accept or reject any videos because they provide a disappointing experience at our discretion.</p>
          <h3>Country or Region-Specific Restrictions</h3>
          <p>Some countries in which we distribute content may have more restrictive standards than other countries for what qualifies as "Offensive Content,"" or "Illegal and Infringing Content." This may include limitations on the display of tobacco branding and drug use; content containing offensive, illegal, or infringing depictions may be subject to publication restrictions in certain territories.</p>
          <p>We may restrict any title from sale in any country or region where the sale or distribution of that content would violate that country's or region's laws, cultural norms, or sensitivities or for any other reason at our discretion.</p>
          <p>&nbsp;</p>
        

        EOT;

        $contentAboutNetbookflix = <<<EOT

        <h1>About the Netbookflix Library Membership Fee</h1>
          <p>Details about the Netbookflix Library membership fee are provided below.</p>
          <p>Enjoy Membership Benefits</p>
          <p><a href="https://www.amazon.in/prime">Sign Up for Library Today</a></p>
          <p>You can sign up for monthly or one-year Netbookflix Library membership, by visiting&nbsp;<a href="http://www.netbookflix.com">www.netbookflix.com</a> .</p>
          <table width="471">
          <tbody>
          <tr>
          <td width="87">
          <p><strong>Pricing Plan</strong></p>
          </td>
          <td width="64">
          <p><strong>Monthly</strong></p>
          </td>
          <td width="64">
          <p><strong>Yearly</strong></p>
          </td>
          <td width="256">
          <p><strong>Offering</strong></p>
          </td>
          </tr>
          <tr>
          <td width="87">
          <p>Basic</p>
          </td>
          <td width="64">
          <p>199</p>
          </td>
          <td width="64">
          <p>999</p>
          </td>
          <td width="256">
          <p>Unlimited Books and Class Notes</p>
          </td>
          </tr>
          <tr>
          <td width="87">
          <p>Intermediate</p>
          </td>
          <td width="64">
          <p>250</p>
          </td>
          <td width="64">
          <p>1750</p>
          </td>
          <td width="256">
          <p>Unlimited Books and Class Notes with self-assessment</p>
          </td>
          </tr>
          <tr>
          <td width="87">
          <p>Advanced</p>
          </td>
          <td width="64">
          <p>599</p>
          </td>
          <td width="64">
          <p>5999</p>
          </td>
          <td width="256">
          <p>Unlimited Books and Class Notes, Audio books, Video clips &amp; lectures along with self-assessment &amp; Analytics</p>
          </td>
          </tr>
          </tbody>
          </table>
          <p>&nbsp;</p>
          <p><strong>Note:</strong></p>
          <ul>
          <li>If you have subscribed to the monthly plan then your membership will auto-renew every month. This auto-renewal is subject to the applicable terms and conditions, available.</li>
          <li>If you were eligible for the free trial then your membership will be automatically renewed to the annual plan, subject to the applicable terms and conditions, available.</li>
          </ul>



        EOT;

        $contentRecuuringPayment = <<<EOT

        <p>Last Updated: July 17, 2020.</p>
        <p>Welcome to the terms and conditions for Recurring Payments for auto renewal of Netbookflix Library membership ("<strong>Terms</strong>"). These Terms are between you and Netbookflix Learning Resource Private Limited ("<strong>Netbookflix</strong>", "<strong>We</strong>" or "<strong>Us</strong>") and/or its affiliates and govern our respective rights and obligations in relation to recurring payment services offered by us on&nbsp;www.netbookflix.com&nbsp;("<strong>Netbookflix.in</strong>") for auto renewal of Netbookflix Library membership ("<strong>Membership</strong>").</p>
        <p>Please note that your use of Netbookflix.com is also governed by the agreements listed and linked to below, as well as all other applicable terms, conditions, limitations, and requirements on the Netbookflix.com website, which (as changed over time) are incorporated into these Terms.</p>
        <ul>
        <li>com condition of use</li>
        <li>com Privacy Notice</li>
        </ul>
        <p>&nbsp;</p>
        <p>Your Membership will be governed by the Netbookflix Library Terms and Conditions, available&nbsp;here.</p>
        <p><strong>Recurring Payments</strong></p>
        <p>The payments for a Membership that is offered by affiliate(s) of Netbookflix, may be made on a recurring basis (such payments, "<strong>Recurring Payments</strong>").</p>
        <p>It is clarified that the Membership is provided on a subscription basis, and a customer is required to make periodic payments to continue to avail the services and the benefits of the Membership. The Membership may be offered under different plans for varying durations, such as monthly or annual, as may be determined by the entity offering the Membership. You may opt for any Membership plan offered, subject to the terms and conditions of the Membership.</p>
        <p>Netbookflix or its affiliates may, at any time, without any notice to you, discontinue offering Recurring Payments for a Membership.</p>
        <p>You will not be bound to avail Recurring Payments for the payments towards your Membership, and you may opt to cancel the Recurring Payments for your Membership in the event Recurring Payments option is available and has been enabled. In the event Recurring Payments has been initiated for your Membership, you agree to be bound by these Terms in addition to the terms and conditions applicable to your Membership.</p>
        <p><strong>Eligible Payment Methods</strong></p>
        <p>Recurring Payments may be available for the Membership only in the event a payment method registered with your Netbookflix.com account and selected by you for the purpose of Recurring Payments is current, valid and acceptable to us, for the purpose of Recurring Payments. Such method is hereinafter referred to as "Payment Method".</p>
        <p>We reserve the right to decide the Payment Methods eligible for Recurring Payments. We may also choose to extend the Recurring Payments to selected Payment Methods or products offered by a bank. In other words, our recognition of a specific Payment Method or product offered by a particular bank would not imply our recognition of other Payment Methods or products offered by such bank.</p>
        <p>Netbookflix may provide you the option to change your Payment Method for payment of Membership fees using Recurring Payments, provided however such Payment Method is eligible for Recurring Payments. In the event the option is made available by Netbookflix and in case of such change, to activate Recurring Payments through such new Payment Method, you will need to enable Recurring Payments on such new Payment Method.</p>
        <p>You are solely responsible for the accuracy of the information about the Payment Method provided by you, including without limitation card (credit or debit) details.</p>
        <p><strong>Enable Recurring Payments</strong></p>
        <p>Recurring Payments will be enabled automatically for your Membership, if you chose an eligible Payment Method. Recurring Payments may also be initiated at the time you are changing the plan for your Membership. In such cases of change, Recurring Payments will be enabled for a Membership plan, even if the same was not enabled for the previous plan of the Membership.</p>
        <p>Once Recurring Payments has been enabled, your Membership will auto renew for the duration of the Membership plan chosen by you and you will be charged automatically for the Membership fees, through the Payment Method registered with your Netbookflix.com account and selected by you for Recurring Payments, on the last day of each Membership plan. For avoidance of any doubts, it is clarified that auto renewal will be effective on the expiry of your then current Membership plan.</p>
        <p>Your Membership may begin with a free trial or promotional period, and the payments of Membership fees may be charged on expiry of such period, if the Recurring Payments is enabled for your Membership. Under such free trial or promotional period, you may not be required to pay any Membership fees or may be required to pay a discounted amount of Membership fees.</p>
        <p>Before Recurring, Payments is enabled and effected for your Membership, a token amount may be charged on the Payment Method proposed to be used by you (for Recurring Payments), for verification or authentication purposes. Once the verification or authentication is successful, you will be registered for Recurring Payments and the token amount charged will be refunded to you. This verification or authentication shall also be conducted undertaken in case of a change in the Membership plan, if the subsequent plan chosen by you is eligible for Recurring Payments, as a result of which Recurring Payments is being enabled for such subsequent plan.</p>
        <p>You agree, understand and acknowledge that Netbookflix may engage third party payment processors or gateway service providers to facilitate processing of Recurring Payments. Accordingly, you may be required to adhere any terms and conditions of such third-party payment processors or gateway service providers, as communicated to you, from time to time.</p>
        <p><strong>Membership</strong></p>
        <p>Membership will be made available to you, upon payment being charged to your Payment Method.</p>
        <p>Once Recurring Payments has been enabled for your Membership, you authorize us to charge the Membership fees for the duration of the next Membership plan during the subsistence of your Membership, unless you cancel or disable Recurring Payment, by means specified by us and applicable at such time. In this case your Membership will not renew automatically.</p>
        <p>In case you cancel your Membership before the end of then current Membership plan, you will not be entitled to any compensation, monetary or otherwise, from Netbookflix and/or its affiliates for the unutilized period of your Membership plan. It is clarified that the refund of the Membership fees (if any) shall be governed by Netbookflix Terms and Conditions. The amount of Membership fees shall be governed by the terms of the Membership, and you acknowledge that the same is subject to change.</p>
        <p><strong>Disable or Cancel Recurring Payments</strong></p>
        <p>You may and have the sole right to decide to cancel or disable Recurring Payments for your Membership either by contacting customer support or in the settings or preferences of your Amazon.in account. For avoidance of any doubts, it is clarified that if you cancel or disable Recurring Payments or auto renewal of your Membership, your then on-going Membership will continue for the remainder of the Membership period, however in the event you cancel or disable Recurring Payments during the free trail or promotional period, any unavailed period shall lapse and will not be available to you.</p>
        <p>In the event: (a) you cancel or disable Recurring Payments or auto renewal of your Membership, or (b) one of your Recurring Payments is declined for any reason whatsoever, including without limitation, expiry of your card: your Membership will not renew at the end of your then current Membership plan. In such scenarios, you will be required to make payments separately for your Membership fee to continue to avail the Membership for any additional period or duration. Your new Membership plan will begin on the later of: (i) the date on which your then current Membership plan ends, or (ii) the date on which the Payment Method selected by you is successfully charged for such additional period or duration of the Membership.</p>
        <p><strong>Notification and Communication</strong></p>
        <p>You authorize us to communicate with you, through emails, in connection with your Membership and/or Recurring Payments. You acknowledge that we may also communicate with you through our affiliate(s) providing the Membership or the benefits of the Membership to you.</p>
        <p><strong>Disclaimer of Liability</strong></p>
        <p>You agree that we will not be liable for any losses or damages suffered by you on account of your use of Recurring Payments for the Membership, including as a result of any fraud in connection with any payment of Membership fee using your Payment Method.</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>


        EOT;

        $data = [
            ['page_name' => 'contact Us', 'content' => '<h2 class="font-weight-bold text-uppercase  line">Contact Us</h2><p><strong><a href="mailto:support@netbookflix.com">support@netbookflix.com</a></p>' , 'active' => '1', 'slug' => 'contact-us'],
            ['page_name' => 'About Us', 'content' => $contentAboutUs, 'active' => '1', 'slug' => 'about-us'],
            ['page_name' => 'privacy-policy', 'content' => $contentPrivacyPolicy,'active' => '1', 'slug' => 'privacy-policy' ],
            ['page_name' => 'Terms & Conditions', 'content' => $contentTermCondition, 'active' => '1', 'slug' => 'terms-conditions'],
            ['page_name' => 'Conditions of Use', 'content' => $contentConditionOfUse, 'active' => '1', 'slug' => ''],
            ['page_name' => 'About The Netbookflix Library Membership Fee', 'content' => $contentAboutNetbookflix , 'active' => '1', 'slug' => ''],
            ['page_name' => 'Recurring Payments for NETBOOKFLIX Library- Terms', 'content' => $contentRecuuringPayment, 'active' => '1', 'slug' => ''],
            ['page_name' => 'Publisher Direct Digital License Agreement', 'content' => $contentPublisher , 'active' => '1', 'slug' => '']
        ];

        DB::table('cms_pages')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('cms_pages')->truncate();
    }
}
