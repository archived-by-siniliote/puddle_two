<?php

namespace App\Loggable\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoODM;
use Gedmo\Loggable\Document\MappedSuperclass\AbstractLogEntry;
use Gedmo\Loggable\Document\Repository\LogEntryRepository;

#[MongoODM\Document(repositoryClass: LogEntryRepository::class)]
#[MongoODM\Index(keys: ['objectId' => 'asc', 'objectClass' => 'asc', 'version' => 'asc'])]
#[MongoODM\Index(keys: ['loggedAt' => 'asc'])]
#[MongoODM\Index(keys: ['objectClass' => 'asc'])]
#[MongoODM\Index(keys: ['username' => 'asc'])]
class LogEntryPost extends AbstractLogEntry
{
}
