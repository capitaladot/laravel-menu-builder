<?php

namespace MartinBean\MenuBuilder;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Debug\Exception\FatalErrorException;

class MenuItem extends Model {
	protected $table = 'menu_items';
	protected $fillable = [ 
			'menu_id',
			'sort_order' 
	];
	public function navigatable() {
		return $this->morphTo ();
	}
	public function menu() {
		return $this->belongsTo ( 'MartinBean\MenuBuilder\Menu' );
	}
	public function getTitle() {
		if ($this->navigatable)
			try {
				return $this->navigatable->getTitle ();
			} catch ( Symfony\Component\Debug\Exception\FatalErrorException $e ) {
				Log::critical ( 'MenuItem exception', [ 
						$e 
				] );
			}
	}
	public function getUrl() {
		if ($this->navigatable)
			try {
				return $this->navigatable->getUrl ();
			} catch ( Symfony\Component\Debug\Exception\FatalErrorException $e ) {
				Log::critical ( 'MenuItem exception', [ 
						$e 
				] );
			}
	}
}
