<?php

namespace Drupal\content_entity_example\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the message type entity class.
 *
 * @ConfigEntityType(
 *   id = "message_type",
 *   label = @Translation("Message type"),
 *   handlers = {
 *     "list_builder" = "Drupal\content_entity_example\MessageTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\content_entity_example\MessageTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider"
 *     },
 *    "local_action_provider" = {
 *       "collection" = "\Drupal\entity\Menu\EntityCollectionLocalActionProvider",
 *    },
 *    "local_task_provider" = {
 *       "default" = "\Drupal\entity\Menu\DefaultEntityLocalTaskProvider",
 *    },
 *   },
 *   admin_permission = "administer message types",
 *   bundle_of = "message",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/message-types/add",
 *     "delete-form" = "/admin/structure/message-types/{message_type}/delete",
 *     "edit-form" = "/admin/structure/message-types/{message_type}",
 *     "collection" = "/admin/structure/message-types"
 *   }
 * )
 */
class MessageType extends ConfigEntityBundleBase {

}
