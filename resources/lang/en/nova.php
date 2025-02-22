<?php

declare(strict_types=1);

return [
    'actions' => [
        'anime' => [
            'backfill' => [
                'confirmButtonText' => 'Backfill',
                'fields' => [
                    'images' => [
                        'large_cover' => [
                            'help' => 'Use Anilist Resource to map Large Cover Image',
                            'name' => 'Backfill Large Cover',
                        ],
                        'name' => 'Backfill Images',
                        'small_cover' => [
                            'help' => 'Use Anilist Resource to map Small Cover Image',
                            'name' => 'Backfill Small Cover',
                        ],
                    ],
                    'resources' => [
                        'anidb' => [
                            'help' => 'Use the Manami Project Anime Offline Database hosted by yuna.moe to find an AniDB mapping from a MAL, Anilist or Kitsu Resource',
                            'name' => 'Backfill AniDB Resource',
                        ],
                        'anilist' => [
                            'help' => 'Use the MAL, Kitsu or AniDB Resource to find an Anilist mapping',
                            'name' => 'Backfill Anilist Resource',
                        ],
                        'ann' => [
                            'help' => 'Use the Kitsu resource to find an ANN mapping',
                            'name' => 'Backfill ANN Resource',
                        ],
                        'kitsu' => [
                            'help' => 'Use the Kitsu API to find a mapping from a MAL, Anilist, AniDB or ANN Resource',
                            'name' => 'Backfill Kitsu Resource',
                        ],
                        'mal' => [
                            'help' => 'Use the Kitsu, Anilist or AniDB Resource to find a MAL mapping',
                            'name' => 'Backfill MyAnimeList Resource',
                        ],
                        'name' => 'Backfill Resources',
                    ],
                    'studios' => [
                        'anime' => [
                            'help' => 'Use the MAL, Anilist or Kitsu Resource to map Anime Studios',
                            'name' => 'Backfill Anime Studios',
                        ],
                        'name' => 'Backfill Studios',
                    ],
                ],
                'message' => [
                    'resource_required_failure' => 'At least one Resource is required to backfill Anime',
                ],
                'name' => 'Backfill Anime',
            ],
        ],
        'audio' => [
            'delete' => [
                'confirmText' => 'Remove Audio from configured storage disks and from the database?',
                'name' => 'Remove Audio',
            ],
            'move' => [
                'name' => 'Move Audio',
            ],
            'upload' => [
                'name' => 'Upload Audio',
            ],
        ],
        'base' => [
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Confirm',
        ],
        'dump' => [
            'dump' => [
                'confirmButtonText' => 'Dump',
                'fields' => [
                    'mysql' => [
                        'comments' => [
                            'help' => 'Add comments to dump file',
                            'name' => 'Comments',
                        ],
                        'default_character_set' => [
                            'help' => 'Specify default character set',
                            'name' => 'Default Character Set',
                        ],
                        'extended_insert' => [
                            'help' => 'Use multiple-row INSERT syntax',
                            'name' => 'Extended Insert',
                        ],
                        'lock_tables' => [
                            'help' => 'Lock all tables before dumping them',
                            'name' => 'Lock Tables',
                        ],
                        'no_create_info' => [
                            'help' => 'Do not write CREATE TABLE statements that re-create each dumped table',
                            'name' => 'No Create Info',
                        ],
                        'quick' => [
                            'help' => 'Retrieve rows for a table from the server a row at a time',
                            'name' => 'Quick',
                        ],
                        'set_gtid_purged' => [
                            'help' => 'Whether to add SET @@GLOBAL.GTID_PURGED to output',
                            'name' => 'Set GTID Purged',
                            'options' => [
                                'auto' => 'AUTO',
                                'off' => 'OFF',
                                'on' => 'ON',
                            ],
                        ],
                        'single_transaction' => [
                            'help' => 'Issue a BEGIN SQL statement before dumping data from server',
                            'name' => 'Single Transaction',
                        ],
                        'skip_column_statistics' => [
                            'help' => 'Do not add analyze table statements to generate histogram statistics',
                            'name' => 'Skip Column Statistics',
                        ],
                        'skip_comments' => [
                            'help' => 'Do not add comments to dump file',
                            'name' => 'Skip Comments',
                        ],
                        'skip_extended_insert' => [
                            'help' => 'Turn off extended-insert',
                            'name' => 'Skip Extended Insert',
                        ],
                        'skip_lock_tables' => [
                            'help' => 'Do not lock tables before dumping them',
                            'name' => 'Skip Lock Tables',
                        ],
                        'skip_quick' => [
                            'help' => 'Do not retrieve rows for a table from the server a row at a time',
                            'name' => 'Skip Quick',
                        ],
                    ],
                    'postgresql' => [
                        'data_only' => [
                            'help' => 'Dump only the data, not the schema (data definitions).',
                            'name' => 'Data Only',
                        ],
                        'inserts' => [
                            'help' => 'Dump data as INSERT commands (rather than COPY).',
                            'name' => 'Inserts',
                        ],
                    ],
                ],
                'name' => [
                    'document' => 'Dump Document Tables',
                    'wiki' => 'Dump Wiki Tables',
                ],
            ],
            'prune' => [
                'name' => 'Prune Dumps',
            ],
        ],
        'invitation' => [
            'resend' => [
                'confirmButtonText' => 'Resend',
                'confirmText' => 'Are you sure you wish to resend these invitations?',
                'message' => [
                    'failure' => 'Invitation has not been resent for any selected user',
                    'success' => 'Invitation has been resent for :users',
                ],
                'name' => 'Resend Invitation',
            ],
        ],
        'models' => [
            'wiki' => [
                'attach_resource' => [
                    'confirmButtonText' => 'Attach',
                    'fields' => [
                        'link' => [
                            'help' => 'The URL of the resource. Ex: https://myanimelist.net/people/8/, https://anidb.net/creator/3/, https://kaguya.love/',
                            'name' => 'Link',
                        ],
                    ],
                    'name' => 'Attach :site Resource',
                ],
            ],
        ],
        'permission' => [
            'give_role' => [
                'name' => 'Give Role',
            ],
            'revoke_role' => [
                'name' => 'Revoke Role',
            ],
        ],
        'repositories' => [
            'confirmButtonText' => 'Reconcile',
            'name' => 'Reconcile :label',
            'service' => [
                'fields' => [
                    'service' => [
                        'help' => 'The provider that is billing us',
                        'name' => 'Service',
                    ],
                ],
            ],
            'storage' => [
                'fields' => [
                    'path' => [
                        'help' => 'The directory to reconcile. Ex: 2022/Spring/.',
                        'name' => 'Path',
                    ],
                ],
            ],
        ],
        'role' => [
            'give_permission' => [
                'name' => 'Give Permission',
            ],
            'revoke_permission' => [
                'name' => 'Revoke Permission',
            ],
        ],
        'storage' => [
            'delete' => [
                'confirmButtonText' => 'Remove',
            ],
            'move' => [
                'confirmButtonText' => 'Move',
                'fields' => [
                    'path' => [
                        'help' => 'The new location of the file. Ex: 2009/Summer/Bakemonogatari-OP1.webm.',
                        'name' => 'Path',
                    ],
                ],
            ],
            'prune' => [
                'confirmButtonText' => 'Prune',
                'fields' => [
                    'hours' => [
                        'help' => 'Files last modified before the specified time in hours before the present time will be deleted.',
                        'name' => 'Hours',
                    ],
                ],
            ],
            'upload' => [
                'confirmButtonText' => 'Upload',
                'fields' => [
                    'file' => [
                        'help' => 'The file to upload. Files will be uploaded to each configured storage disk.',
                        'name' => 'File',
                    ],
                    'path' => [
                        'help' => 'The directory the file will be uploaded to. Ex: 2022/Spring.',
                        'name' => 'Path',
                    ],
                ],
            ],
        ],
        'studio' => [
            'backfill' => [
                'confirmButtonText' => 'Backfill',
                'fields' => [
                    'images' => [
                        'large_cover' => [
                            'help' => 'Use MAL Resource to map Large Cover Image',
                            'name' => 'Backfill Large Cover',
                        ],
                        'name' => 'Backfill Images',
                    ],
                ],
                'message' => [
                    'resource_required_failure' => 'At least one Resource is required to backfill Studio',
                ],
                'name' => 'Backfill Studio',
            ],
        ],
        'user' => [
            'give_permission' => [
                'name' => 'Give Permission',
            ],
            'give_role' => [
                'name' => 'Give Role',
            ],
            'revoke_permission' => [
                'name' => 'Revoke Permission',
            ],
            'revoke_role' => [
                'name' => 'Revoke Role',
            ],
        ],
        'video_script' => [
            'delete' => [
                'confirmText' => 'Remove Video Script from configured storage disks and from the database?',
                'name' => 'Remove Video Script',
            ],
            'move' => [
                'name' => 'Move Video Script',
            ],
            'upload' => [
                'name' => 'Upload Video Script',
            ],
        ],
        'video' => [
            'backfill' => [
                'confirmButtonText' => 'Backfill',
                'fields' => [
                    'derive_source' => [
                        'help' => 'If Yes, use the source Video to backfill Audio. If No, use this Video to backfill Audio. Yes should be used in most cases. No is useful for outlier videos where we may want an additional Audio to represent the song like a second verse or an SFX version.',
                        'name' => 'Derive Source Video',
                    ],
                    'overwrite' => [
                        'help' => 'If Yes, the Audio will be extracted from the Video even if the Audio already exists. If No, the Audio will only be extracted from the Video if the Audio doesn\'t exist. No should be used in most cases. Yes is useful if we are replacing Audio for a Video.',
                        'name' => 'Overwrite Audio',
                    ],
                ],
                'name' => 'Backfill Audio',
            ],
            'delete' => [
                'confirmText' => 'Remove Video from configured storage disks and from the database?',
                'name' => 'Remove Video',
            ],
            'move' => [
                'name' => 'Move Video',
            ],
            'upload' => [
                'name' => 'Upload Video',
            ],
        ],
    ],
    'fields' => [
        'anime_synonym' => [
            'text' => [
                'help' => 'For alternative titles, licensed titles, common abbreviations and/or shortenings',
                'name' => 'Text',
            ],
        ],
        'anime_theme_entry' => [
            'episodes' => [
                'help' => 'The range(s) of episodes that the theme entry is used. Can be left blank if used for all episodes or if there are not episodes as with movies. Ex: "1-", "1-11", "1-2, 10, 12".',
                'name' => 'Episodes',
            ],
            'notes' => [
                'help' => 'Any additional information not included in other fields that may be useful',
                'name' => 'Notes',
            ],
            'nsfw' => [
                'help' => 'Does the entry include Not Safe For Work content? Set at your discretion. There will not be rigid guidelines to define when this property should be set.',
                'name' => 'NSFW',
            ],
            'spoiler' => [
                'help' => 'Does the entry include content that spoils the show? You may also include up to which episode is spoiled in Notes (Ex: Ep 6 spoilers).',
                'name' => 'Spoiler',
            ],
            'version' => [
                'help' => 'The Version number of the Theme. Can be left blank if there is only one version. Version is only required if there exist at least 2 in the sequence.',
                'name' => 'Version',
            ],
        ],
        'anime_theme' => [
            'group' => [
                'help' => 'For separating sequences belonging to dubs, rebroadcasts, remasters, etc. By default, leave blank.',
                'name' => 'Group',
            ],
            'sequence' => [
                'help' => 'Numeric ordering of theme. If only one theme of this type exists for the show, this can be left blank.',
                'name' => 'Sequence',
            ],
            'slug' => [
                'help' => 'Used as the URL Slug / Model Route Key. By default, this should be the Type and Sequence lowercased and "_" replacing spaces. These should be unique within the scope of the anime. Ex: "OP", "ED1", "OP2-Dub".',
                'name' => 'Slug',
            ],
            'type' => [
                'help' => 'Is this an OP or an ED?',
                'name' => 'Type',
            ],
        ],
        'anime' => [
            'name' => [
                'help' => 'The display title of the Anime. By default, we will use the same title as MAL. Ex: "Bakemonogatari", "Code Geass: Hangyaku no Lelouch", "Dungeon ni Deai wo Motomeru no wa Machigatteiru Darou ka".',
                'name' => 'Name',
            ],
            'season' => [
                'help' => 'The Season in which the Anime premiered. By default, we will use the Premiered Field on the MAL page.',
                'name' => 'Season',
            ],
            'slug' => [
                'help' => 'Used as the URL Slug / Model Route Key. By default, this should be the Name lowercased and "_" replacing spaces. Shortenings/Abbreviations are also accepted. Ex: "monogatari", "code_geass", "danmachi".',
                'name' => 'Slug',
            ],
            'synopsis' => [
                'help' => 'The brief description of the Anime',
                'name' => 'Synopsis',
            ],
            'year' => [
                'help' => 'The Year in which the Anime premiered. By default, we will use the Premiered Field on the MAL page.',
                'name' => 'Year',
            ],
            'resources' => [
                'as' => [
                    'help' => 'Used to distinguish resources that map to the same anime. For example, Aware! Meisaku-kun has one MAL page and many aniDB pages.',
                    'name' => 'As',
                ],
            ],
        ],
        'artist' => [
            'groups' => [
                'as' => [
                    'help' => 'Used in place of the Artist name if the performance is made as a character or group/unit member.',
                    'name' => 'As',
                ],
            ],
            'members' => [
                'as' => [
                    'help' => 'Used in place of the Artist name if the performance is made as a character or group/unit member',
                    'name' => 'As',
                ],
            ],
            'name' => [
                'help' => 'The display title of the Artist. By default, we will use the same title as MAL, but we will prefer "[Given Name] [Family name]". Ex: "Aimer", "Yui Horie", "Fear, and Loathing in Las Vegas".',
                'name' => 'Name',
            ],
            'resources' => [
                'as' => [
                    'help' => 'Used to distinguish resources that map to the same artist. For example, the OxT music unit has a dedicated AnidB page but ANN does not.',
                    'name' => 'As',
                ],
            ],
            'slug' => [
                'help' => 'Used as the URL Slug / Model Route Key. By default, this should be the Name lowercased and "_" replacing spaces. Shortenings/Abbreviations are also accepted. Ex: "aimer", "yui_horie", "falilv"',
                'name' => 'Slug',
            ],
            'songs' => [
                'as' => [
                    'help' => 'Used in place of the Artist name if the performance is made as a character or group/unit member.',
                    'name' => 'As',
                ],
            ],
        ],
        'announcement' => [
            'content' => 'Content',
        ],
        'audio' => [
            'basename' => [
                'name' => 'Basename',
            ],
            'filename' => [
                'name' => 'Filename',
            ],
            'mimetype' => [
                'name' => 'MIME Type',
            ],
            'path' => [
                'name' => 'Path',
            ],
            'size' => [
                'name' => 'Size',
            ],
        ],
        'balance' => [
            'balance' => [
                'help' => 'Current balance of the account with current usage',
                'name' => 'Balance',
            ],
            'date' => [
                'help' => 'The month and year for the balance that we are tracking',
                'name' => 'Date',
            ],
            'frequency' => [
                'help' => 'The frequency that we are billed by the provider',
                'name' => 'Frequency',
            ],
            'service' => [
                'help' => 'The provider that is billing us',
                'name' => 'Service',
            ],
            'usage' => [
                'help' => 'Amount used in the current billing period',
                'name' => 'Usage',
            ],
        ],
        'base' => [
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
            'file_properties' => 'File Properties',
            'id' => 'ID',
            'timestamps' => 'Timestamps',
            'updated_at' => 'Updated At',
        ],
        'dump' => [
            'path' => 'Path',
        ],
        'external_resource' => [
            'external_id' => [
                'help' => 'The identifier used by the external site.',
                'name' => 'External ID',
            ],
            'link' => [
                'help' => 'The URL of the resource. Ex: https://myanimelist.net/people/8/, https://anidb.net/creator/3/, https://kaguya.love/',
                'name' => 'Link',
            ],
            'site' => [
                'help' => 'The site that we are linking to.',
                'name' => 'Site',
            ],
        ],
        'image' => [
            'facet' => [
                'help' => 'The page component that the image is intended for. Example: Is this a small cover image or a large cover image?',
                'name' => 'Facet',
            ],
            'image' => [
                'name' => 'Image',
            ],
            'path' => [
                'name' => 'Path',
            ],
        ],
        'invitation' => [
            'email' => 'Email',
            'name' => 'Name',
            'status' => 'Status',
        ],
        'page' => [
            'body' => [
                'help' => 'The content of the Page.',
                'name' => 'Body',
            ],
            'name' => [
                'help' => 'The display title of the Page.',
                'name' => 'Name',
            ],
            'slug' => [
                'help' => 'Used as the URL Slug / Model Route Key. By default, this should be the Name lowercased and "_" replacing spaces.',
                'name' => 'Slug',
            ],
        ],
        'permission' => [
            'name' => 'Name',
        ],
        'role' => [
            'name' => 'Name',
        ],
        'series' => [
            'name' => [
                'help' => 'The display title of the Series. Ex: "Monogatari", "Code Geass", "Dungeon ni Deai wo Motomeru no wa Machigatteiru Darou ka".',
                'name' => 'Name',
            ],
            'slug' => [
                'help' => 'Used as the URL Slug / Model Route Key. By default, this should be the Name lowercased and "_" replacing spaces. Shortenings/Abbreviations are also accepted. Ex: "monogatari", "code_geass", "danmachi".',
                'name' => 'Slug',
            ],
        ],
        'setting' => [
            'key' => 'Key',
            'value' => 'Value',
        ],
        'song' => [
            'title' => [
                'help' => 'The title of the song',
                'name' => 'Title',
            ],
        ],
        'studio' => [
            'name' => [
                'help' => 'The display title of the Studio',
                'name' => 'Name',
            ],
            'resources' => [
                'as' => [
                    'help' => 'Used to distinguish resources that map to the same studio.',
                    'name' => 'As',
                ],
            ],
            'slug' => [
                'help' => 'Used as the URL Slug / Model Route Key. By default, this should be the Name lowercased and "_" replacing spaces. Shortenings/Abbreviations are also accepted.',
                'name' => 'Slug',
            ],
        ],
        'transaction' => [
            'amount' => [
                'help' => 'How much are we being billed for or receiving?',
                'name' => 'Amount',
            ],
            'date' => [
                'help' => 'The date at which the transaction occurred',
                'name' => 'Date',
            ],
            'description' => [
                'help' => 'What is this transaction for?',
                'name' => 'Description',
            ],
            'external_id' => [
                'help' => 'The identifier used by the service for this transaction, if applicable',
                'name' => 'External ID',
            ],
            'service' => [
                'help' => 'The provider that is billing us',
                'name' => 'Service',
            ],
        ],
        'user' => [
            'email' => 'Email',
            'name' => 'Name',
        ],
        'video_script' => [
            'path' => 'Path',
        ],
        'video' => [
            'basename' => [
                'name' => 'Basename',
            ],
            'filename' => [
                'name' => 'Filename',
            ],
            'lyrics' => [
                'help' => 'Set if this video has subtitles for song lyrics.',
                'name' => 'Lyrics',
            ],
            'mimetype' => [
                'name' => 'MIME Type',
            ],
            'nc' => [
                'help' => 'Set if this video is creditless.',
                'name' => 'NC',
            ],
            'overlap' => [
                'help' => 'The degree to which the sequence and episode content overlap. None: No overlap. Transition: partial overlap. Over: full overlap.',
                'name' => 'Overlap',
            ],
            'path' => [
                'name' => 'Path',
            ],
            'resolution' => [
                'help' => 'Frame height of the video',
                'name' => 'Resolution',
            ],
            'size' => [
                'name' => 'Size',
            ],
            'source' => [
                'help' => 'Where did this video come from?',
                'name' => 'Source',
            ],
            'subbed' => [
                'help' => 'Set if this video has subtitles of dialogue.',
                'name' => 'Subbed',
            ],
            'uncen' => [
                'help' => 'Set if this video is an uncensored version of a censored sequence.',
                'name' => 'Uncensored',
            ],
        ],
    ],
    'lenses' => [
        'anime' => [
            'images' => [
                'name' => 'Anime Without :facet Image',
            ],
            'resources' => [
                'name' => 'Anime Without :site Resource',
            ],
            'studios' => [
                'name' => 'Anime Without Studios',
            ],
        ],
        'artist' => [
            'images' => [
                'name' => 'Artist Without :facet Image',
            ],
            'resources' => [
                'name' => 'Artist Without :site Resource',
            ],
            'songs' => [
                'name' => 'Artist Without Songs',
            ],
        ],
        'audio' => [
            'video' => [
                'name' => 'Audio Without Video',
            ],
        ],
        'external_resource' => [
            'unlinked' => [
                'name' => 'Resource Without Anime or Artist or Studio',
            ],
        ],
        'image' => [
            'unlinked' => [
                'name' => 'Image Without Anime or Artist',
            ],
        ],
        'song' => [
            'artist' => [
                'name' => 'Songs Without Artists',
            ],
        ],
        'studio' => [
            'images' => [
                'name' => 'Studio Without :facet Image',
            ],
            'resources' => [
                'name' => 'Studio Without :site Resource',
            ],
            'unlinked' => [
                'name' => 'Studio Without Anime or Studio',
            ],
        ],
        'video' => [
            'audio' => [
                'name' => 'Video Without Audio',
            ],
            'resolution' => [
                'name' => 'Video with Unset Resolution',
            ],
            'script' => [
                'name' => 'Video Without Script',
            ],
            'source' => [
                'name' => 'Video with Unknown Source Type',
            ],
            'unlinked' => [
                'name' => 'Video Without Entries',
            ],
        ],
    ],
    'menu' => [
        'main' => [
            'section' => [
                'lenses' => 'Lenses',
            ],
        ],
    ],
    'metrics' => [
        'ranges' => [
            'trend' => [
                '30' => '30 Days',
                '60' => '60 Days',
                '90' => '90 Days',
            ],
            'value' => [
                '30' => '30 Days',
                '60' => '60 Days',
                '365' => '365 Days',
                'mtd' => 'Month To Date',
                'qtd' => 'Quarter To Date',
                'today' => 'Today',
                'yesterday' => 'Yesterday',
                'ytd' => 'Year To Date',
            ],
        ],
    ],
    'resources' => [
        'group' => [
            'admin' => 'Admin',
            'auth' => 'Auth',
            'billing' => 'Billing',
            'document' => 'Document',
            'wiki' => 'Wiki',
        ],
        'label' => [
            'anime_synonyms' => 'Anime Synonyms',
            'anime_theme_entries' => 'Anime Theme Entries',
            'anime_themes' => 'Anime Themes',
            'anime' => 'Anime',
            'announcements' => 'Announcements',
            'artists' => 'Artists',
            'audios' => 'Audios',
            'balances' => 'Balances',
            'dumps' => 'Dumps',
            'external_resources' => 'External Resources',
            'groups' => 'Groups',
            'images' => 'Images',
            'invitations' => 'Invitations',
            'members' => 'Members',
            'pages' => 'Pages',
            'permissions' => 'Permissions',
            'roles' => 'Roles',
            'series' => 'Series',
            'settings' => 'Settings',
            'songs' => 'Songs',
            'studios' => 'Studios',
            'transactions' => 'Transactions',
            'users' => 'Users',
            'video_scripts' => 'Video Scripts',
            'videos' => 'Videos',
        ],
        'singularLabel' => [
            'anime_synonym' => 'Anime Synonym',
            'anime_theme_entry' => 'Anime Theme Entry',
            'anime_theme' => 'Anime Theme',
            'anime' => 'Anime',
            'announcement' => 'Announcement',
            'artist' => 'Artist',
            'audio' => 'Audio',
            'balance' => 'Balance',
            'dump' => 'Dump',
            'external_resource' => 'External Resource',
            'image' => 'Image',
            'invitation' => 'Invitation',
            'page' => 'Page',
            'permission' => 'Permission',
            'role' => 'Role',
            'series' => 'Series',
            'setting' => 'Setting',
            'song' => 'Song',
            'studio' => 'Studio',
            'transaction' => 'Transaction',
            'user' => 'User',
            'video_script' => 'Video Script',
            'video' => 'Video',
        ],
    ],
];
