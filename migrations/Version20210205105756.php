<?php
class Version20210205105756 implements \Hlis\Migration\Script
{
    /**
     * Commits changes
     */
    public function up(): void
    {
        SQL("CREATE TABLE casino_statuses_extended
        (
        id tinyint not null auto_increment,
        status_id tinyint unsigned not null,
        PRIMARY KEY(id),
        KEY(status_id)
        ) Engine=INNODB");
        SQL("INSERT INTO casino_statuses_extended VALUES
        (1, 0), (2, 3), (3, 2), (4, 1)");
    }
    
    /**
     * Rolls back changes
     */
    public function down(): void
    {
        
    }
}

