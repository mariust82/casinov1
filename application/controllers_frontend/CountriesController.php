<?php
class CountriesController extends Controller {
    public function run() {
        $this->response->setAttribute("menu_top", array (
  0 => 
  array (
    'title' => 'CASINOS',
    'url' => '/casinos',
    'is_active' => false,
  ),
  1 => 
  array (
    'title' => 'SOFTWARES',
    'url' => '/softwares',
    'is_active' => false,
  ),
  2 => 
  array (
    'title' => 'BONUSES',
    'url' => '/bonus-list',
    'is_active' => false,
  ),
  3 => 
  array (
    'title' => 'COUNTRIES',
    'url' => '/countries',
    'is_active' => true,
  ),
  4 => 
  array (
    'title' => 'COMPATIBILITY',
    'url' => '/compatability',
    'is_active' => false,
  ),
  5 => 
  array (
    'title' => 'BANKING',
    'url' => '/banking',
    'is_active' => false,
  ),
  6 => 
  array (
    'title' => 'FEATURES',
    'url' => '/features',
    'is_active' => false,
  ),
  7 => 
  array (
    'title' => 'GAMES',
    'url' => '/games',
    'is_active' => false,
  ),
));
$this->response->setAttribute("results", array (
  'Sweden' => '1029',
  'New Zealand' => '1002',
  'Norway' => '989',
  'Liechtenstein' => '989',
  'Iceland' => '981',
  'San Marino' => '980',
  'Aland Islands' => '968',
  'Saint Kitts and Nevis' => '961',
  'Sint Maarten (Dutch part)' => '961',
  'Saint Lucia' => '960',
  'Saint Eustatius and Saba Bonaire' => '959',
  'Switzerland' => '958',
  'Chile' => '955',
  'Svalbard and Jan Mayen' => '955',
  'Uruguay' => '953',
  'Monaco' => '950',
  'Finland' => '949',
  'Jersey' => '949',
  'Andorra' => '947',
  'Guernsey' => '947',
  'Malta' => '946',
  'Seychelles' => '945',
  'Barbados' => '943',
  'Tonga' => '942',
  'Federated States of Micronesia' => '942',
  'Tokelau' => '941',
  'Bermuda' => '939',
  'Bahamas' => '939',
  'Saint Vincent and the Grenadines' => '939',
  'Madagascar' => '937',
  'Holy See (Vatican City State)' => '936',
  'Luxembourg' => '936',
  'Isle of Man' => '933',
  'South Georgia and the South Sandwich Islands' => '932',
  'Montserrat' => '932',
  'Trinidad and Tobago' => '931',
  'Germany' => '929',
  'Anguilla' => '929',
  'Turks and Caicos Islands' => '928',
  'Solomon Islands' => '927',
  'Austria' => '927',
  'Christmas Island' => '926',
  'Maldives' => '924',
  'Paraguay' => '924',
  'El Salvador' => '923',
  'Fiji' => '923',
  'Suriname' => '923',
  'Tuvalu' => '923',
  'Peru' => '922',
  'Pitcairn Islands' => '921',
  'Macedonia' => '920',
  'Niue' => '919',
  'Guatemala' => '918',
  'Aruba' => '918',
  'Saint Helena' => '918',
  'Honduras' => '918',
  'Palau' => '918',
  'Mauritius' => '918',
  'Dominican Republic' => '917',
  'Falkland Islands (Malvinas)' => '915',
  'Faroe Islands' => '914',
  'Venezuela' => '914',
  'The Democratic Republic of the Congo' => '914',
  'Colombia' => '913',
  'Lesotho' => '911',
  'Mali' => '910',
  'Sao Tome and Principe' => '910',
  'Marshall Islands' => '909',
  'Norfolk Island' => '908',
  'Jamaica' => '908',
  'Kazakhstan' => '907',
  'British Virgin Islands' => '907',
  'Botswana' => '907',
  'United Republic of Tanzania' => '907',
  'Ireland' => '907',
  'Grenada' => '906',
  'Brunei Darussalam' => '905',
  'Vanuatu' => '905',
  'Cameroon' => '904',
  'British Indian Ocean Territory' => '904',
  'Togo' => '903',
  'Georgia' => '903',
  'Timor-Leste' => '902',
  'Mongolia' => '902',
  'Kiribati' => '902',
  'Qatar' => '902',
  'Gambia' => '902',
  'Gabon' => '900',
  'Brazil' => '900',
  'Egypt' => '900',
  'Swaziland' => '899',
  'Cayman Islands' => '899',
  'Bolivia' => '899',
  'Cocos (Keeling) Islands' => '899',
  'Cape Verde' => '898',
  'Mexico' => '897',
  'Nepal' => '897',
  'Djibouti' => '897',
  'Equatorial Guinea' => '896',
  'Senegal' => '896',
  'Greenland' => '895',
  'United Arab Emirates' => '895',
  'Argentina' => '894',
  'Saudi Arabia' => '894',
  'Mozambique' => '894',
  'Zambia' => '894',
  'Dominica' => '892',
  'Burkina Faso' => '892',
  'South Sudan' => '892',
  'Oman' => '890',
  'Comoros' => '889',
  'Curacao' => '888',
  'Tunisia' => '887',
  'Namibia' => '885',
  'Palestinian Territory' => '884',
  'Benin' => '883',
  'Central African Republic' => '883',
  'Bahrain' => '883',
  'Macau' => '881',
  'Belize' => '880',
  'Malawi' => '880',
  'Sri Lanka' => '880',
  'Nicaragua' => '880',
  'Vietnam' => '879',
  'Ghana' => '878',
  'Cook Islands' => '877',
  'Kenya' => '874',
  'Lebanon' => '873',
  'Saint Barthelemy' => '872',
  'Sierra Leone' => '872',
  'Haiti' => '872',
  'Guinea-Bissau' => '871',
  'Bhutan' => '871',
  'Panama' => '870',
  'Mauritania' => '870',
  'Gibraltar' => '867',
  'Burundi' => '866',
  'Liberia' => '865',
  'Morocco' => '864',
  'Chad' => '861',
  'Rwanda' => '861',
  'Lao People\'s Democratic Republic' => '859',
  'Saint Martin' => '857',
  'Taiwan' => '855',
  'Congo' => '852',
  'Ecuador' => '850',
  'Turkmenistan' => '849',
  'Papua New Guinea' => '847',
  'Kyrgyzstan' => '847',
  'Costa Rica' => '847',
  'Republic of Moldova' => '846',
  'Republic of Korea' => '845',
  'Japan' => '842',
  'Eritrea' => '842',
  'Jordan' => '842',
  'Cambodia' => '840',
  'Tajikistan' => '837',
  'Guinea' => '835',
  'Saint Pierre and Miquelon' => '833',
  'Cote D\'Ivoire' => '832',
  'Guyana' => '832',
  'Antigua and Barbuda' => '831',
  'Uzbekistan' => '830',
  'New Caledonia' => '829',
  'French Southern Territories' => '825',
  'Kuwait' => '824',
  'Slovakia' => '824',
  'Nauru' => '822',
  'Wallis and Futuna' => '818',
  'Mayotte' => '818',
  'Canada' => '816',
  'Montenegro' => '814',
  'Ethiopia' => '805',
  'Martinique' => '803',
  'Reunion' => '800',
  'Greece' => '800',
  'Algeria' => '794',
  'Guadeloupe' => '794',
  'Uganda' => '790',
  'Armenia' => '789',
  'India' => '786',
  'Bangladesh' => '784',
  'Democratic People\'s Republic of Korea' => '782',
  'Azerbaijan' => '780',
  'Belarus' => '778',
  'Croatia' => '776',
  'Northern Mariana Islands' => '776',
  'Thailand' => '775',
  'Cuba' => '772',
  'Somalia' => '771',
  'Bosnia and Herzegovina' => '771',
  'Angola' => '771',
  'Malaysia' => '763',
  'Latvia' => '757',
  'Slovenia' => '755',
  'Albania' => '751',
  'Niger' => '750',
  'Serbia' => '748',
  'Samoa' => '747',
  'Virgin Islands US' => '744',
  'Lithuania' => '744',
  'Puerto Rico' => '743',
  'Portugal' => '742',
  'China' => '741',
  'French Polynesia' => '739',
  'Nigeria' => '738',
  'Ukraine' => '738',
  'Australia' => '733',
  'American Samoa' => '729',
  'Poland' => '728',
  'Islamic Republic of Iran' => '725',
  'United Kingdom' => '725',
  'Zimbabwe' => '724',
  'Hong Kong' => '717',
  'Czech Republic' => '714',
  'French Guiana' => '714',
  'Libya' => '712',
  'Singapore' => '711',
  'Cyprus' => '709',
  'Yemen' => '706',
  'Russian Federation' => '702',
  'Guam' => '701',
  'South Africa' => '697',
  'Indonesia' => '691',
  'Philippines' => '685',
  'Myanmar' => '682',
  'Estonia' => '658',
  'Sudan' => '657',
  'Netherlands' => '657',
  'Pakistan' => '652',
  'Syrian Arab Republic' => '622',
  'Iraq' => '596',
  'Afghanistan' => '591',
  'Hungary' => '574',
  'United States Minor Outlying Islands' => '573',
  'Bulgaria' => '554',
  'Belgium' => '528',
  'Italy' => '527',
  'Romania' => '509',
  'Denmark' => '495',
  'Turkey' => '459',
  'Spain' => '420',
  'France' => '323',
  'United States' => '203',
  'Israel' => '38',
));

    }
}
        