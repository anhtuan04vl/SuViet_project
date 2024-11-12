import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
          colors: {
            'cmain': '#194569', //xanh 515151
            'cmain1': '#515151', //text-carts
            'cmain2': '#454545', //grey

            'cmain3': '#444444', //text
            'cmain4' : '#453F2F', // nau opacity
            'cmain5' : 'rgba(255, 97, 49, 0.2)', //xám
            'cmain6' : 'rgba(25, 69, 105, 0.15)', //xanh nuoc bien
            'cmain7' : '#5F84A3' //button
          },
          screens: {
            'sm' : '500px',
            'md' : '641px',
            'lg' : '1025px',
            "xl": "1366px",
            "2xl": "1441px",
            "3xl": "1600px",
            "375": "376px",
            "400": "401px",
            "600": "601px",
            "700": "701px",
            "800": "801px",
            "900": "901px",
            "1024": "1025px",
          },
          fontFamily: {
            'el': ['Manrope', "sans-serif"],
            //'body': ['Roboto', "sans-serif"],
            //'el' : ['Roboto', 'sans-serif'],
            //'RobotoCon': ['Roboto Condensed', 'sans-serif'],
            //'Futura': ['SFU Futura','sans-serif'],
           // 'Poppins': ['SVN-Poppins', 'sans-serif'],
            //'Inter': ['Inter', 'sans-serif']
        },
        backgroundImage: {
          // 'form': "url('../images/bn.lg.png')",
          'form2': "url('../../images/banner(4).png')",
          'form3': "url('../../images/ft_banner.png')",
          'form4': "url('../../images/bg_freq.png')",
          'form5': "url('../../images/banner(2).png')",
          /*'process': "url('../../img/bgprocess.png')",
          'post': "url('../../img/bgpost.png')",
          'footer': "url('../../img/bgfooter.png')"*/
      },
        },
    },
    plugins: [],
};
