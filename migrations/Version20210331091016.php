<?php
class Version20210331091016 implements \Hlis\Migration\Script
{
    /**
     * Commits changes
     */
    public function up(): void
    {
        SQL("CREATE TABLE casinos__visits
        (
        id int(10) not null auto_increment,
        user_ip varchar(45) not null,
        casino_id int(10) null,
        date_time timestamp,
        PRIMARY KEY(id),
        ) Engine=INNODB");

        SQL("ALTER TABLE casinos__visits ADD INDEX (user_ip)");
        SQL("ALTER TABLE casinos__visits ADD INDEX (casino_id)");
    }
    
    /**
     * Rolls back changes
     */
    public function down(): void
    {
        
    }
}

