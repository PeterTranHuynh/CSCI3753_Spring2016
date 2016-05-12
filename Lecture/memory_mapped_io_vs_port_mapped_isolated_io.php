<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Embedded Systems Programming: Memory-mapped I/O vs port-mapped I/O - 2016</title>
  <meta
 content="Embedded Systems RTOS(Real Time Operating System),Memory-mapped I/O vs port-mapped I/O, Microprocessors normally use two methods to connect external devices: memory mapped or port mapped I/O. However, as far as the peripheral is concerned, both methods are really identical.
Memory mapped I/O is mapped into the same address space as program memory and/or user memory, and is accessed in the same way.
Port mapped I/O uses a separate, dedicated address space and is accessed via a dedicated set of microprocessor instructions."
 name="description" />
  <meta
 content="Embedded Systems RTOS(Real Time Operating System),Memory-mapped I/O vs port-mapped I/O"
 name="keywords" />
  <meta http-equiv="Content-Type"
 content="text/html; charset=ISO-8859-1" />
   <link type="text/css" rel="stylesheet" href="../images/bogostyleWidePre.css" />
  <link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
  
<!-- Google+ -->
<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
</head>
<body>
<div id="page" align="center">

<div id="tops">
	<div class="container_full">
		<div class="bogo" id="bogo"><a href="/index.php"><b>bogo</b>to<b>bogo</b></a></div>

		<div id="right_menu">
			<div class="topmenu">
				<!--<a href="http://www.bogotobogo.com/index.php">Home</a> -->
				<a href="/about_us.php">About Us</a>
				<a href="/products.php">Products</a>
				<a href="/our_services.php">Our Services</a>
				<a href="/contact_us.php" target="_blank">Contact Us</a>
			</div>

			<div id="menu_search_box">
				<form action="http://www.google.com" id="cse-search-box" target="_blank">
				  <div>
				    <input type="hidden" name="cx" value="partner-pub-4716428189734495:1794050961" />
				    <input type="hidden" name="ie" value="UTF-8" />
				    <input type="text" name="q" size="55" id="menu_search" autocomplete="off"/>
				    <input type="submit" name="sa" value="" id="menu_search_button" />
				  </div>
				</form>

				<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>
				</div>
			</div>
		</div>

	<div id="main_menu">
		<div class="container_full">
			<a href="/Qt/Qt5_Creating_QtQuick2_QML_Application_Animation_A.php">Qt5</a>
			<a href="/Android/android.php">Android</a>
			<!--
			<a href="/JQuery/JQuery_document_ready_click_function.php">jQuery</a>
			-->
			<a href="/Algorithms/algorithms.php">Algorithms</a>
			<a href="/cplusplus/cpptut.php">C++</a>
			<!--
			<a href="/Linux/linux_tips1.php">Linux</a>
			-->
			<a href="/Java/tutorials/on_java.php">Java</a>
			<a href="/Hadoop/BigData_hadoop_Install_on_ubuntu_single_node_cluster.php">BigData</a>
			 
			<a href="/DesignPatterns/introduction.php">Design Patterns</a>
			 
			<a href="/python/pytut.php">Python/Django</a> 
			<a href="/CSharp/.netframework.php">C#</a>
			
			<a href="/AngularJS/AngularJS_Introduction.php">Angular/NodeJS</a>
			
			 
			<a href="/DevOps/DevOps_Jenkins_Chef_Puppet_Graphite_Logstash.php">DevOps</a>
			 
			<a href="/FFMpeg/ffmpeg_cropdetect_ffplay.php">FFmpeg</a>
			<a href="/Matlab/Matlab_Tutorial_Manipulating_Audio_I_Reverse_Delay_Tone_Control_Changing_Speed_Removing_Vocals.php">Matlab</a>
			<a href="/python/OpenCV_Python/python_opencv3_Image_Hough%20Circle_Transform.php">OpenCV</a>
			<a href="/VideoStreaming/videostreaming_etc.php">Streaming</a>
                        <a href="/AmazingPlaces/index.php" target="_blank">
<img src="/Menus/MenuIcons/Earth_8px_transparent_background.png"
width="24" height="24"/></a> 
		</div>
	</div>

</div>
<div class="linklist">
<h1>Embedded Programming related sections</h1>
<ul>
   <li><a href="http://www.bogotobogo.com/cplusplus/embeddedSystemsProgramming.php">Embedded Systems Programming I - Introduction</a></li>
    <li><a href="http://www.bogotobogo.com/cplusplus/embeddedSystemsProgramming_gnu_toolchain_ARM_cross_compiler.php">Embedded Systems Programming II - gcc ARM Toolchain ans Simple Code on Ubuntu and Fedora</a></li>
   <li><a href="http://www.bogotobogo.com/cplusplus/embeddedSystemsProgramming_GNU_ARM_ToolChain_Eclipse_CDT_plugin.php">Embedded Systems Programming III - Eclipse CDT Plugin for gcc ARM Toolchain </a></li>
   <li><a href="http://www.bogotobogo.com/Embedded/memory_mapped_io_vs_port_mapped_isolated_io.php">Memory-mapped I/O vs Port-mapped I/O</a> </li>
   <li><a href="http://www.bogotobogo.com/Embedded/hardware_interrupt_software_interrupt_latency_irq_vs_fiq.php">Interrupt & Interrupt Latency</a> </li>
    <li><a href="http://www.bogotobogo.com/Embedded/Little_endian_big_endian_htons_htonl.php">Little Endian/Big Endian & TCP Sockets</a> </li>
   <li><a href="http://www.bogotobogo.com/cplusplus/quiz_bit_manipulation.php">Bit Manipulation</a> </li> 
   <li><a href="http://www.bogotobogo.com/Linux/linux_process_and_signals.php">Linux Processes and Signals</a> </li>
   <li><a href="http://www.bogotobogo.com/Linux/linux_drivers_1.php">Linux Drivers 1</a> </li>   
</ul>
<div class="skyscraper"><br>

<div class="skyscraper">

<!-- Paypal Donate button -->

<p><i><b>Sponsor Open Source development activities and free contents for everyone</b>.</i></p>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<p><i>Thank you.</i></p>
<p>- <a href="http://bogotobogo.com/about_us.php" target="_blank">K Hong</a></p>
<!-- End of Paypal Donate button   -->


<br><br>



<!--
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
-->



<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- bogo_skyscraper -->
<ins class="adsbygoogle"
     style="display:inline-block;width:160px;height:600px"
     data-ad-client="ca-pub-4716428189734495"
     data-ad-slot="5321096966"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>


<br><br>




</div></div>

</div>
<div id="contenttext">

<div class="AdSenseSearch">

<!--
<form action="http://www.google.com" id="cse-search-box" target="_blank">
  <div>
    <input type="hidden" name="cx" value="partner-pub-4716428189734495:1794050961" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="55" />
    <input type="submit" name="sa" value="Search" />
  </div>
</form>

<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>

<br><br>-->

<!-- Share this -->
<span class='st__large' displayText=''></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "b9569c43-5f56-4501-92f0-4bf4aa8fceb0", doNotHash: false, doNotCopy: true, hashAddressBar: false});</script>

</div>


<div id="bookmarkshare">
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=khhong7"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=khhong7"></script>
</div>

<br />
<div style="padding: 10px;"><span class="titletext">Memory-mapped I/O vs port-mapped I/O - 2016    <g:plusone></g:plusone></span></div>



<link rel="stylesheet" type="text/css" href="/media/css/scrollable-horizontal.css" />
<link rel="stylesheet" type="text/css" href="/media/css/scrollable-buttons.css" />
<link rel="stylesheet" type="text/css" href="/media/css/picture-box.css" />
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>


<div class="blurb">
<h1 class="teaser title">Bogotobogo's contents</h1>
<p>
  To see more items, click left or right arrow.
</p>

<div class="box full" >
<div style="margin:0 auto; width: 734px; height:120px;">
<!-- "previous page" action -->
<a class="prev browse left"></a>
 
<!-- root element for scrollable -->
<div class="scrollable" id="scrollable">
 
  <!-- root element for the items -->
  <div class="items">
 
    <!-- 1-5 -->
    <div>
      <a href="http://www.bogotobogo.com/cplusplus/cpptut.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Cpp_Image.png" /> </a>
      <a href="http://www.bogotobogo.com/Qt/Qt5_Creating_QtQuick2_QML_Application_Animation_A.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Qt5_Image.png" /></a>
      <a href="http://www.bogotobogo.com/python/pytut.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Python_Image.png" /> </a>
      <a href="http://www.bogotobogo.com/Android/android.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Android_Image.png" /> </a>
      
    </div>
 
    <!-- 5-10 -->
    <div>
      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Manipulating_Audio_I_Reverse_Delay_Tone_Control_Changing_Speed_Removing_Vocals.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab_Image.png" /> </a>
      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Hough%20Circle_Transform.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV3_Image.png" /></a>
      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_cropdetect_ffplay.php" target="_blank"> 
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFMpeg_Image.png" /></a>
      <a href="http://www.bogotobogo.com/php/phptut.php" target="_blank"> 
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/PHP_Image.png" /></a>
      
    </div>
 
    <!-- 10-15 -->
    <div>
      <a href="http://www.bogotobogo.com/CSharp/.netframework.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/CSharp_Image.png" /></a>
      <a href="http://www.bogotobogo.com/VisualBasicSQL/introduction.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/VisualBacis_Image.png" /></a>
      <a href="http://www.bogotobogo.com/AngularJS/AngularJS_Introduction.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/AngularJS_logo.png" /> </a>
      <a href="http://www.bogotobogo.com/JQuery/JQuery_document_ready_click_function.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/jQuery_Image.png" /></a>
    </div>
 
    <!-- 16-20 -->
    <div>
      <a href="http://www.bogotobogo.com/Algorithms/algorithms.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Algorithms_Image.png" /></a>
      <a href="http://www.bogotobogo.com/DesignPatterns/introduction.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Design_Patterns_Image.png" /></a>
      <a href="http://www.bogotobogo.com/VideoStreaming/videostreaming_etc.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/VideoStreaming_Image.png" /></a>
      <a href="http://www.bogotobogo.com/Java/tutorials/on_java.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Java_Image.png" /></a>
    </div>

    <!-- 21-25 -->
    <div>
      <a href="http://www.bogotobogo.com/RubyOnRails/RubyOnRails.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/RubyOnRails_Image.png" /></a>
      <a href="http://www.bogotobogo.com/iPhone/iPhone.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/iOS_Image.png" /></a>
      <a href="http://www.bogotobogo.com/HTML5/OnHTML5.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/HTML5_Image.png" /></a>
      <a href="http://www.bogotobogo.com/Linux/linux_tips1.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Linux_Image.png" /> </a>    
    </div>

    <!-- 26-30 -->
    <div>
      <a href="http://www.bogotobogo.com/python/Django/Python_Django_tutorial_introduction.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Django_Image.png" /></a>
      <a href="http://www.bogotobogo.com/python/scikit-learn/scikit_machine_learning_Supervised_Learning_Unsupervised_Learning.php"/ target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Scikit-learn_Image.png" /></a>
      <a href="http://www.bogotobogo.com/php/Laravel4/php_laravel4_framework_install_on_Windows.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Laravel_Image.png" /></a>
      
      <a href="http://www.bogotobogo.com/cplusplus/embeddedSystemsProgramming.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/EmbeddedRTOS.png" /></a>
    </div>

    <!-- 31-35 -->
    <div>
      <a href="http://www.bogotobogo.com/cplusplus/Git/Git_GitHub_Express.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/git_github_image.png" /></a>
      <a href="http://www.bogotobogo.com/SVG/svg.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/SVG_Image.png" /> </a>
      <a href="http://www.bogotobogo.com/DevOps/DevOps_Jenkins_Chef_Puppet_Graphite_Logstash.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/DevOps_icon.png" /> </a>
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Coming_Soon_Image.png" />
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Hadoop_Blur_Image.png" />
      
    </div>

    <!-- 36-40 -->
    <div>
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCL_Blur_Image.png" />
    </div>
  </div> <!-- items -->

</div> <!-- scrollable -->
 
<!-- "next page" action -->
<a class="next browse right"></a>
</div>

<!-- javascript coding -->
<script>
$(function() {
  // initialize scrollable
  $(".scrollable").scrollable();
});
</script>
</div> <!-- box full -->
<p>
<a class="standalone"
          href="/about_us.php">I hope this site is informative and helpful.</a></p>
</div> <!-- blurb -->
<br><br><br>

<!-- bogoMatched --- Disabled Jan 27, 2016 site too slow
<p>The menu below shows my contents recommended by Google's matched algorithm.</p>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:inline-block;width:528px;height:90px"
     data-ad-client="ca-pub-4716428189734495"
     data-ad-slot="8603617761"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<br><br>
-->
<!-- Google search box -->
<div class="AdSenseSearch">
bogotobogo.com site search:
<form action="http://www.google.com" id="cse-search-box" target="_blank">
  <div>
    <input type="hidden" name="cx" value="partner-pub-4716428189734495:1794050961" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="55" />
    <input type="submit" name="sa" value="Search" />
  </div>
</form>
<br>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- bogo-responsive-1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-4716428189734495"
     data-ad-slot="4437853761"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<br><br><link rel="stylesheet" type="text/css" href="/media/css/scrollable-horizontal.css" />
<link rel="stylesheet" type="text/css" href="/media/css/scrollable-buttons.css" />
<link rel="stylesheet" type="text/css" href="/media/css/picture-box.css" />
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>


<div class="blurb">
<h2 class="teaser title sub">Bogotobogo   Image / Video Processing </h1>
<h1 class="teaser title">Computer Vision & Machine Learning</h2>
<p>
  with OpenCV, MATLAB, FFmpeg, and scikit-learn.
</p>

<div class="box full" >
<div style="margin:0 auto; width: 734px; height:120px;">
<!-- "previous page" action -->
<a class="prev browse left"></a>
 
<!-- root element for scrollable -->
<div class="scrollable" id="scrollable">
 
  <!-- root element for the items -->
  <div class="items">
 
    <!-- 1-5 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/OpenCV/opencv_3_tutorial_ubuntu13_install_cmake.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/lena_Ubuntu_opencv.png" 
      title="Installing on Ubuntu 13 and loading an image"/> </a>

      <a href="http://www.bogotobogo.com/OpenCV/opencv_3_tutorial_mat_object_image_matrix_image_container.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/matrix_Mat_object.png" 
      title="Mat(rix) object (Image Container)"/> </a>

      <a href="http://www.bogotobogo.com/OpenCV/opencv_3_tutorial_creating_mat_objects.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/ThreeChannelArray.png" 
      title="Creating Mat objects, zeros(), ones(), eye() and clone()"/> </a>

      <a href="http://www.bogotobogo.com/OpenCV/opencv_3_tutorial_load_convert_save_image.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/Dostoevsky.png" 
      title="The core - Image load, convert and save"/> </a>
      
    </div>
 
    <!-- 5-10 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/OpenCV/opencv_3_tutorial_imgproc_gausian_median_blur_bilateral_filter_image_smoothing.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/zebra1.png" 
      title="Smoothing Filters A - Average and Gaussian Blur"/> </a>

      <a href="http://www.bogotobogo.com/OpenCV/opencv_3_tutorial_imgproc_gausian_median_blur_bilateral_filter_image_smoothing_B.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/zebra2.png" 
      title="Smoothing Filters B - Median, Bilateral"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/OpenCVwithPython.png" 
      title="OpenCV 3 with Python"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_matplotlib_rgb_brg_image_load_display_save.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/bgr_Matplot.png" 
      title="OpenCV BGR : Matplotlib RGB, There is a difference in pixel ordering in OpenCV and Matplotlib."/> </a>
      
    </div>
 
    <!-- 10-15 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_basic_image_operations_pixel_access_image_load.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/CloudyGoldenGate_grayscale.jpg" 
      title="Basic image operations - pixel access"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_NumPy_Arrays_Signal_Processing_iPython.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/iPython_FFT_Random.png" 
      title="iPython - Signal Processing with NumPy"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Signal_Processing_with_NumPy_Fourier_Transform_FFT_DFT.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/Signal_FFT_square_5_Hz.png" 
      title="Signal Processing with NumPy I - FFT & DFT for sine, square waves, unitpulse, and random signal"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Signal_Processing_with_NumPy_Fourier_Transform_FFT_DFT_2.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/NumPyFFT_maze.png" 
      title="Signal Processing with NumPy II - Image Fourier Transform : FFT & DFT"/> </a>
      
    </div>
 
    <!-- 16-20 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Fourier_Transform_FFT_DFT.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/cv2_dft_xfiles.png" 
      title="Inverse Fourier Transform of an Image with low pass filter: cv2.idft()"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_image_histogram_calcHist.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/Histo_gray.png" 
      title="Image Histogram"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Changing_ColorSpaces_RGB_HSV_HLS.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/RGB_HSV.png" 
      title="Video Capture & Switching colorspaces - RGB / HSV"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Global_Thresholding_Adaptive_Thresholding_Otsus_Binarization_Segmentations.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/OpenCV_Otsu_Thresholding3.png" 
      title="Adaptive Thresholding - Otsu's clustering-based image thresholding"/> </a>
      
    </div>

    <!-- 21-25 -->

    <div id = "pics">
      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Gradient_Sobel_Laplacian_Derivatives_Edge_Detection.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/SanFrancisco_out.png" 
      title="Edge Detection - Sobel and Laplacian Kernels"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Canny_Edge_Detection.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/Canny_Edge_Detection.png" 
      title="Canny Edge Detection"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Hough%20Circle_Transform.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/Hough_eye_51.png" 
      title="Hough Transform - Circles"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Watershed_Algorithm_Marker_Based_Segmentation.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/WaterShed_Dilation.png" 
      title="Watershed Algorithm : Marker-based Segmentation I"/> </a>
      
    </div>

    <!-- 26-30 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Watershed_Algorithm_Marker_Based_Segmentation_2.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/WaterShed_input_output.png" 
      title="Watershed Algorithm : Marker-based Segmentation II"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Non-local_Means_Denoising_Algorithm_Noise_Reduction.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/Denoising_Gaussian_Gray.png" 
      title="Image noise reduction : Non-local Means denoising algorithm"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Object_Detection_Face_Detection_Haar_Cascade_Classifiers.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/xfiles4.png" 
      title="Image object detection : Face detection using Haar Cascade Classifiers"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_Segmentation_by_Foreground_Extraction_Grabcut_Algorithm_based_on_Graph_cuts.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/bolt.jpg" 
      title="Image segmentation - Foreground extraction Grabcut algorithm based on graph cuts"/> </a>
      
    </div>

    <!-- 31-35 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Image_reconstruction_Inpainting_Interpolation.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/Output_4_pics.png" 
      title="Image Reconstruction - Inpainting (Interpolation) - Fast Marching Methods"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_mean_shift_tracking_segmentation.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/MeanShiftPic.png" 
      title="Video : Mean shift object tracking"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Machine_Learning_Clustering_K-Means_Clustering_Vector_Quantization.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/Hist_1D.png" 
      title="Machine Learning : Clustering - K-Means clustering I"/> </a>

      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Machine_Learning_Classification_K-nearest_neighbors_k-NN.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/Hist_1D_2.png" 
      title="Machine Learning : Clustering - K-Means clustering II"/> </a>
      
    </div>

    <!-- 36-40 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/python/OpenCV_Python/python_opencv3_Machine_Learning_Classification_K-nearest_neighbors_k-NN.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/kNN_2.png" 
      title="Machine Learning : Classification - k-nearest neighbors (k-NN) algorithm"/> </a>

      <img src="http://www.bogotobogo.com/media/img/TopicLogo/OpenCV/more_image_processing.png" 
      title="Continue..."/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Vector_Matrix.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab_Image.png" 
      title="Matlab - Vectors and Matrices"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_M_Files_scripts.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/m_files.png" 
      title="mfiles - Matlab script files"/> </a>
      
    </div>

    <!-- 41-45 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_For_Loop.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/sum_1_to_10_ForLoop.png" 
      title="For loop for loop_index = vector"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Indexing_Masking_Array_Vector_Matrix.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/ArrayMasking.png" 
      title="Indexing and masking"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Vector_Array_Audio_Wave_File_Plot_Play.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/DrumAudioTwoChannels_2.png" 
      title="Vectors and arrays with audio files"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Manipulating_Audio_I_Reverse_Delay_Tone_Control_Changing_Speed_Removing_Vocals.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/ReversedAudio.png" 
      title="Manipulating Audio I : Reverse play and delay audio"/> </a>
      
    </div>

    <!-- 46-50 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Manipulating_Audio_2_Reverse_Delay_Tone_Control_Changing_Speed_Removing_Vocals.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/Matlab_Audio2.png" 
      title="Manipulating Audio II : Playing with stereo sound, tone control, changing Speed, removing vocals"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Introduction_to_FFT_DFT_Fast_Fourier_Transform.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/FFT_DFT_Diagram.png" 
      title="Introduction to FFT & DFT"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_DFT_Discrete_Fourier_Transform.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/DFT_results.png" 
      title="Discrete Fourier Transform (DFT)"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Digital_Image_Processing_I.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/RGB_BerkeleyTower.png" 
      title="Digital Image Processing 1 - 7 basic functions "/> </a>
 
    </div>

    <!-- 51-55 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Digital_Image_Processing_2_RGB_Indexed_Color_Info.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/ImgProc2.png" 
      title="Digital Image Processing 2 - RGB image & indexed image"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Digital_Image_Processing_3_Grayscale_RGB.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/Einstein.jpg" 
      title="Digital Image Processing 3 - Grayscale image I"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Digital_Image_Processing_4_Grayscale_RGB_II.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/bit_plane1.png" 
      title="Digital Image Processing 4 - Grayscale image II (image data type and bit-plane)"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Digital_Image_Processing_5_Histogram_Equalization_imhist_histeq_imadjust.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/two_histogram_in_one_pic.png" 
      title="Digital Image Processing 5 - Histogram equalization"/> </a>
      
    </div>

    <!-- 56-60 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Digital_Image_Processing_6_Filter_Smoothing_Low_Pass_fspecial_filter2.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/noise_in_rgb_image.png" 
      title="Digital Image Processing 6 - Image Filter (Low pass filters)"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Video_Processing_1_Object_Detection_by_Color_Thresholding.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/Matlab_Object_Detect_Run2.png" 
      title="Video Processing 1 - Object detection (tagging cars) by thresholding color"/> </a>

      <a href="http://www.bogotobogo.com/Matlab/Matlab_Tutorial_Video_Processing_2_Face_Detection_CamShift_Tracking.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/DetectedFace.png" 
      title="Video Processing 2 - Face Detection and CAMShift Tracking"/> </a>

      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Matlab/more_image_processing.png" 
      title="More image processing"/> 
      
    </div>

    <!-- 61-65 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_image_scaling_jpeg.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFMpeg_Image.png" 
      title="Image/video scaling"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_cropping_video_image.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/cropped_blue_umbrella_025.png" 
      title="Image/video cropping - crop=712:534"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_cropdetect_ffplay.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/ffmpeg_cropdetect.png" 
      title="Cropdetect and ffplay : crop=out_width:out_height:x:y"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_video_speed_up_dlow_down.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/ffmpeg_video_speed_up_dlow_down.png" 
      title="Speeding-up & slowing-down video"/> </a>
      
    </div>

    <!-- 66-70 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_basic_slide_show_from_images_jpeg.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/slide_show.png" 
      title="Basic slide show from images"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_adv_slide_show_from_images_jpeg.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/Adv_Slide_Show.png" 
      title="Advanced slide show from images"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_thumbnails_select_scene_iframe.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/thumnail_iframe.png" 
      title="Thumbnails -Selecting specific frames : I-frame extraction etc."/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_seeking_ss_option_cutting_section_video_image.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/seek_cut_sections.png" 
      title="Seeking and cutting sections of a video & audio"/> </a>
      
    </div>

    <!-- 71-75 -->
    <div id = "pics">

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_concatenating_two_videos.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/concat.png" 
      title="Concatenating two video files or two audio files"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_fade_in_fade_out_transitions_effects_filters.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/fade_in_out.png" 
      title="Transitions : fade-in & fade-out for 1 slide"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_fade_in_fade_out_transitions_effects_filters_two_slides.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/fade_in_out_two.png" 
      title="Transitions : python script for fade-in & fade-out with two slides"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_fade_in_fade_out_transitions_effects_filters_slideshow_concat.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/slide_concat.png" 
      title="Concatenate slides"/> </a>
      
    </div>

    <!-- 76-80 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_video_test_patterns_src.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/creating_test_video.png" 
      title="Creating test videos"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_video_screencasting_screen_recording_capture.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/screencasting.png" 
      title="Screen Recording on Ubuntu A"/> </a>

      <a href="http://www.bogotobogo.com/FFMpeg/ffmpeg_video_screencasting_screen_recording_capture_active_current_top_window.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/FFmpeg/ActiveCapture.png" 
      title="Active window capture with Python on Ubuntu B"/> </a>

      <img src="http://www.bogotobogo.com/media/img/TopicLogo/arrow_scikit-learn.png" 
      title="Machine Learning with scikit-learn"/> 
      
    </div>


    <!-- 81-86 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/python/scikit-learn/scikit-learn_install.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/Scikit-learn_Image.png" 
      title="scikit-learn installation"/> </a>

      <a href="http://www.bogotobogo.com/python/scikit-learn/scikit-learn_install.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/scikit-learn/feature_extraction.png" 
      title="Features and feature extraction - iris dataset"/> </a>

      <a href="http://www.bogotobogo.com/python/scikit-learn/scikit_machine_learning_Supervised_Learning_Unsupervised_Learning.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/scikit-learn/supervised.png" 
      title="Supervised Learning Unsupervised Learning - e.g. Unsupervised PCA dimensionality reduction with iris dataset"/> </a>

      <a href="http://www.bogotobogo.com/python/scikit-learn/scikit_machine_learning_Unsupervised_Learning_Clustering.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/scikit-learn/un_supervised.png" 
      title="Unsupervised_Learning - KMeans clustering with iris dataset"/> </a>


      
    </div>


    <!-- 81-86 -->
    <div id = "pics">
      <a href="http://www.bogotobogo.com/python/scikit-learn/scikit_machine_learning_Linearly_Separable_NonLinearly_RBF_Separable_Data_SVM_GUI.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/scikit-learn/NonlinearlySeparable.png" 
      title="Linearly Separable Data - Linear Model & (Gaussian) radial basis function kernel (RBF kernel)"/> </a>

      <a href="http://www.bogotobogo.com/python/scikit-learn/scikit_machine_learning_Support_Vector_Machines_SVM.php" target="_blank">
      <img src="http://www.bogotobogo.com/media/img/TopicLogo/scikit-learn/svm.png" 
      title="Support Vector Machines (SVM)"/> </a>

      
    </div>

  </div> <!-- items -->

</div> <!-- scrollable -->
 
<!-- "next page" action -->
<a class="next browse right"></a>
</div>

<!-- javascript coding -->
<script>
$(function() {
  // initialize scrollable
  $(".scrollable").scrollable();
});

$("#pics img[title]").tooltip();
</script>
</div> <!-- box full -->
<p>
<a class="standalone"
          href="/about_us.php">I hope this site is informative and helpful.</a></p>
</div> <!-- blurb -->

<div class="bodytext" style="padding: 12px;" align="justify">
<div class="subtitle" id="memory_mapped_port_mapped_io">Memory-mapped IO vs Port-mapped IO </div>
<p>Microprocessors normally use two methods to connect external devices: <strong>memory mapped</strong> or <strong>port mapped</strong> I/O. However, as far as the peripheral is concerned, both methods are really identical.</p>
<p>Memory mapped I/O is mapped into the same address space as program memory and/or user memory, and is accessed in the same way.<p>
<p>
Port mapped I/O uses a separate, dedicated address space and is accessed via a dedicated set of microprocessor instructions.</p>
<p>The difference between the two schemes occurs within the microprocessor. Intel has, for the most part, used the port mapped scheme for their microprocessors and Motorola has used the memory mapped scheme.</p>
<p>As 16-bit processors have become obsolete and replaced with 32-bit and 64-bit in general use, reserving ranges of memory address space for I/O is less of a problem, as the memory address space of the processor is usually much larger than the required space for all memory and I/O devices in a system.</p>
<p>Therefore, it has become more frequently practical to take advantage of the benefits of memory-mapped I/O. However, even with address space being no longer a major concern, neither I/O mapping method is universally superior to the other, and there will be cases where using port-mapped I/O is still preferable.</p>
<br />
<div class="subtitle_2nd" id="memory_mapped_io">Memory-mapped IO (MMIO)</div>
<br />
<img src="http://www.bogotobogo.com/Embedded/images/memery_mapped_port_mapped_io/Memory_mapped_io.png" alt="Memory_mapped_io.png"/>
<p>Picture source : <a href="http://www.grimware.org/doku.php/documentations/devices/io.devices" target="_blank">IO Devices</a></p>
<p>I/O devices are mapped into the system memory map along with RAM and ROM. To access a hardware device, simply read or write to those 'special' addresses using the normal memory access instructions.</p>
<p>The advantage to this method is that every instruction which can access memory can be used to manipulate an I/O device. </p>
<p>The disadvantage to this method is that the entire address bus must be fully decoded for every device. For example, a machine with a 32-bit address bus would require logic gates to resolve the state of all 32 address lines to properly decode the specific address of any device. This increases the cost of adding hardware to the machine.</p>

<br />
<div class="subtitle_2nd" id="port_mapped_io">Port-mapped IO (PMIO or Isolated IO)</div>
<br />
<img src="http://www.bogotobogo.com/Embedded/images/memery_mapped_port_mapped_io/Port_Mapped_io.png" alt="Port_Mapped_io.png"/>
<p>Picture source : <a href="http://www.grimware.org/doku.php/documentations/devices/io.devices" target="_blank">IO Devices</a></p>
<p>I/O devices are mapped into a separate address space. This is usually accomplished by having a different set of signal lines to indicate a memory access versus a port access. The address lines are usually shared between the two address spaces, but less of them are used for accessing ports. An example of this is the standard PC which uses 16 bits of port address space, but 32 bits of memory address space. </p>
<p>The advantage to this system is that less logic is needed to decode a discrete address and therefore less cost to add hardware devices to a machine. On the older PC compatible machines, only 10 bits of address space were decoded for I/O ports and so there were only 1024 unique port locations; modern PC's decode all 16 address lines. To read or write from a hardware device, special port I/O instructions are used.</p>
<p> From a software perspective, this is a slight disadvantage because more instructions are required to accomplish the same task. For instance, if we wanted to test one bit on a memory mapped port, there is a single instruction to test a bit in memory, but for ports we must read the data into a register, then test the bit.</p>
</p>




<script type="text/javascript"><!--
google_ad_client = "ca-pub-4716428189734495";
/* bogo_LargeRectangle_336_280 */
google_ad_slot = "2712696561";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>

<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<br /><br />

<!-- bogoMatched - NO DISPLAY : SLOW
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:inline-block;width:528px;height:90px"
     data-ad-client="ca-pub-4716428189734495"
     data-ad-slot="8603617761"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
-->

<!-- Google search box -->
<div class="AdSenseSearch">
bogotobogo.com site search:
<form action="http://www.google.com" id="cse-search-box" target="_blank">
  <div>
    <input type="hidden" name="cx" value="partner-pub-4716428189734495:1794050961" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="55" />
    <input type="submit" name="sa" value="Search" />
  </div>
</form>

<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>

</div>

<br />


<div class="subtitle_2nd" id="port_mapped_io_comparison">Comparison - Memory-mapped vs port-mapped</div>

<br />
 <!-- TABLE -->
  <table border="2" cellpadding="6" cellspacing="1" width="600">
      <tr>
        <th align="middle">Memory-mapped IO</th>
        <th align="middle">Port-mapped IO</th>
      </tr>
      <tr>
        <td align="middle">Same address bus to address memory and I/O devices</td>
        <td align="middle">Different address spaces for memory and I/O devices</td>
      </tr>
      <tr>
        <td align="middle">Access to the I/O devices using regular instructions</td>
        <td align="middle">Uses a special class of CPU instructions to access I/O devices</td>
      </tr>
      <tr>
        <td align="middle">Most widely used I/O method</td>
        <td align="middle">x86 Intel microprocessors - IN and OUT instructions</td>
      </tr>

  </table>
<br />
<br />
<br />
<div class="subtitle_2nd" id="resource_monitor">Resource Monitor</div>
<p>We can check the reserved memory address space from the Resource Monitor via our desktop's Task Manager.</p>
<br />
<img src="http://www.bogotobogo.com/Embedded/images/memery_mapped_port_mapped_io/ResourceMonitor_ReservedMemory.png" alt="ResourceMonitor_ReservedMemory.png"/>
<br />


<!-- search box and footer ad links -->
<br><br><br><br>
<!-- moved to ../footer.php -->


</div>
</div>


<!-- search box and footer ad links -->

<div class="AdLinksSmallFooter">

<script type="text/javascript"><!--
google_ad_client = "ca-pub-4716428189734495";
/* bogo_links_small_horizontal_footer */
google_ad_slot = "4490165367";
google_ad_width = 468;
google_ad_height = 15;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>


<br><br>
</div>
<!-- Disqus -->
<div id="disqus_thread"></div>
<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
     */
    
    var disqus_config = function () {
        this.page.url = window.location.href;
        this.page.identifier = document.title;
    };
    
    (function() {  // REQUIRED CONFIGURATION VARIABLE: EDIT THE SHORTNAME BELOW
        var d = document, s = d.createElement('script');
        
        s.src = '//bogotobogocom.disqus.com/embed.js';  // IMPORTANT: Replace EXAMPLE with your forum shortname!
        
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

<!-- Disqus ends here -->

<br />
<br />
<br />
<br />


<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- bogoMatchedResponsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-4716428189734495"
     data-ad-slot="7890847760"
     data-ad-format="autorelaxed"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>



<br /><br /><br /><br />

<div class="AdSenseSearchFooter">

<br><br>

<style type="text/css">
@import url(http://www.google.com/cse/api/branding.css);
</style>
<div class="cse-branding-bottom" style="background-color:#999999;color:#000000">
  <div class="cse-branding-form">
    <form action="http://www.google.com" id="cse-search-box">
      <div>
        <input type="hidden" name="cx" value="partner-pub-4716428189734495:5827297765" />
        <input type="hidden" name="ie" value="UTF-8" />
        <input type="text" name="q" size="55" />
        <input type="submit" name="sa" value="Search" />
      </div>
    </form>
  </div>
  <div class="cse-branding-logo">
    <img src="http://www.google.com/images/poweredby_transparent/poweredby_999999.gif" alt="Google" />
  </div>
  <div class="cse-branding-text">
    Custom Search
  </div>
</div>




<br><br>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43017326-1', 'bogotobogo.com');
  ga('send', 'pageview');

</script>

<div id="footer">
	<a href="http://www.bogotobogo.com/index.php">Home</a>
	| <a href="http://www.bogotobogo.com/about_us.php">About Us</a>
	| <a href="http://www.bogotobogo.com/products.php">Products</a>
	| <a href="http://www.bogotobogo.com/our_services.php">Our Services</a>
	| <a href="http://www.bogotobogo.com/about_us.php">Contact Us</a>
	| Bogotobogo &copy; 2016 | 
	<a href="">Back to Top </a>
</div>
</div></div>


\
</body>
</html>