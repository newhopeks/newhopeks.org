/*
 * This script was built for the www.newhopeks.org web site. 
 *
 * Copyright (c) 2007 Andrew Sterling Hanenkamp <hanenkamp@cpan.org>.
 * 
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation; either version 2 of the License, or (at your
 * option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for 
 * more details.
 *
 * IF you need a copy of this license, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA.
 */

// Changes these to switch the images that slide up in the top banner
var sliderImages = [
	'pic_1.png',
	'pic_2.png',
	'pic_3.png',
	'pic_4.png'
];

function doSlider(first, image) {
	if (first) {
		$("#slider").attr("src", image.src);
		$("#slider").SlideInDown("slow");
	}
	else {
		$("#slider").SlideOutDown("slow",
			function() {
				$("#slider").attr("src", image.src);
				$("#slider").SlideInDown("slow");
			}
		);
	}
}

function createSliderAnimation(first, image) {
	return function() { doSlider(first, image) };
}

function pickImage(doNotPick) {
	var pickImage;
	do {
		pickImage = sliderImages.splice(
			Math.floor(Math.random() * sliderImages.length), 1);
	} while (pickImage[0] == doNotPick);

	// Slide the slider image cookie for the next page
	document.cookie = 'newhope_slider_image=' + pickImage[0];

	var image = new Image();
	image.src = themeDir + "/images/sliders/" + pickImage[0];

	return image;
}

function doSliders() {
	var image;

	// If they have a slider cookie, continue the previous slider
	if (/\bnewhope_slider_image=/.test(document.cookie)) {
		var removePick = document.cookie.match(/\bnewhope_slider_image=([^;]+)/);
		image = pickImage(removePick[1]);
		setTimeout(createSliderAnimation(false, image), 2000);
	}

	// No slider cookie, so do the intro slider
	else {
	
		// Slide in a new image every 5 seconds, random order
		var first = true;
		for (var i = 0; i < 3; ++i) {
			image = pickImage();
			setTimeout(createSliderAnimation(first, image), 500 + 5000 * i);
			first = false;
		}
	}

}

$(doSliders);
