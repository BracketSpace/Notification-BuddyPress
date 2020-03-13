<?php
/**
 * Group trigger abstract
 *
 * @package notification/buddypress
 */

namespace BracketSpace\Notification\BuddyPress\Components\Trigger;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\MergeTag;
use BracketSpace\Notification\BuddyPress\Components\MergeTag\Group as GroupMergeTag;

/**
 * Group trigger class
 */
abstract class Group extends Abstracts\Trigger {

	/**
	 * Constructor
	 *
	 * @param array $params Trigger configuration params.
	 */
	public function __construct( $params = array() ) {

		if ( ! isset( $params['slug'], $params['name'] ) ) {
			trigger_error( 'Group trigger requires slug and name params.', E_USER_ERROR );
		}

		parent::__construct( $params['slug'], $params['name'] );

		$this->set_group( __( 'BuddyPress : Group', 'notification' ) );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		// Group.
		$this->add_merge_tag( new GroupMergeTag\ID() );
		$this->add_merge_tag( new GroupMergeTag\ParentID() );
		$this->add_merge_tag( new GroupMergeTag\CreatorID() );
		$this->add_merge_tag( new GroupMergeTag\Name() );
		$this->add_merge_tag( new GroupMergeTag\Slug() );
		$this->add_merge_tag( new GroupMergeTag\Description() );
		$this->add_merge_tag( new GroupMergeTag\Status() );
		$this->add_merge_tag( new GroupMergeTag\ForumEnabled() );

	}

}
