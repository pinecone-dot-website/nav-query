jQuery(document).ready( function($){
	"use strict";
	
	/*
	*
	*/
	$( document ).ajaxSuccess( function(e, xhr, settings){
	    var request = {}, 
	    	pairs = settings.data.split('&'), 
	    	i, split, widget;

		for( i in pairs ){
			split = pairs[i].split('=' );
			request[decodeURIComponent(split[0])] = decodeURIComponent(split[1] );
		}
		
		// reset title and checkbox
		if( request['menu-item[-1][menu-item-type]'] == 'wp_query' ){
			$('#nav-query-post input[type=checkbox]').attr( 'checked', 1 );
			$('#nav-query-post input[type=text]').val( 'WP_Query' );
		}	
	} );

	/*
	*
	*/
	$("div.nav-query textarea").each( function(i, item){
		var $item = $(item);
		
		new nav_query( $item );
		$item.add_button( 'Author', 'author', '""', 'Display posts by author, using author id' );
		$item.add_button( 'Post In', 'post__in', '[0]', 'use post ids. Specify posts to retrieve.' );
		$item.add_button( 'Tax Query', 'tax_query', '[{"relation": "and"}, [{ "taxonomy": "movie_genre", "field": "slug", "terms":["action", "comedy"] }]]', 'use taxonomy parameters' );
		
		return;
	} );
	
	/*
	*
	*	@param jquery textarea
	*	@return jquery textarea
	*/
	function nav_query( $item ){
		/*
		*
		*	@param string
		*	@param string
		*	@param string json parsable
		*	@param string
		*/
		$item.__proto__.add_button = function( title, arg_name, arg_default, help_text ){
			var $button = jQuery( '<button>' ).html( title ).attr( 'title', help_text ).click( function(e){
				var params = $item.data( 'nav-query-params' );
				
				if( params ){
					params[arg_name] = JSON.parse( arg_default );
					$item.val( JSON.stringify(params, null, "\t") );
				}
					
				e.preventDefault();
			} );
		
			$item.next('div.ui').append( $button );
		}
		
		/*
		*
		*/
		$item.to_json = function(){
			var json = $item.val();
			
			try{
				json = JSON.parse( json );
			} catch( e ){
				json = {};
			}
			
			$item.data( 'nav-query-params', json );
		};
		
		/*
		*
		*/
		$item.keydown( function(e){
			if( e.keyCode == 9 ){
				// get caret position/selection
		        var start = this.selectionStart;
		        var end = this.selectionEnd;
		
		        var value = $item.val();
		
		        // set textarea value to: text before caret + tab + text after caret
		        $item.val( value.substring(0, start)
		                    + "\t"
		                    + value.substring(end) );
		
		        // put caret at right position again (add one for the tab)
		        this.selectionStart = this.selectionEnd = start + 1;
		        
				 // prevent the focus lose
        		e.preventDefault();
			}
		} );
		
		/*
		*
		*/
		$item.keyup( function(e){
			$item.to_json();
		} );
		
		/*
		*
		*/
		$item.to_json();
		$item.after( $('<div/>').attr('class', 'ui') );
		
		return $item;
	};
} )