<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('iso');
            $table->text('name');
            $table->text('nicename');
            $table->string('iso3')->nullable();
            $table->integer('numcode')->nullable();
            $table->integer('phonecode');
        });

        

        DB::unprepared(
            "INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (44, 'CN', 'CHINA', 'China', 'CHN', 156, 86);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (46, 'CC', 'COCOS INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (KEELING) ISLANDS', 'Cocos INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (Keeling) Islands', NULL, NULL, 672);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (53, 'CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384, 225);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (69, 'FK', 'FALKLAND ISLANDS INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (MALVINAS)', 'Falkland Islands INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (Malvinas)', 'FLK', 238, 500);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (94, 'VA', 'HOLY SEE INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (VATICAN CITY STATE)', 'Holy See INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (Vatican City State)', 'VAT', 336, 39);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (99, 'IN', 'INDIA', 'India', 'IND', 356, 91);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (112, 'KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', 408, 850);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (116, 'LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', 418, 856);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (168, 'PE', 'PERU', 'Peru', 'PER', 604, 51);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260);
        INSERT INTO countries (id, iso, name, nicename, iso3, numcode, phonecode) VALUES  (239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);"
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
