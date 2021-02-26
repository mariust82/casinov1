<?php
class Version20210226105756 implements \Hlis\Migration\Script
{
    /**
     * Commits changes
     */
    public function up(): void
    {
        SQL("ALTER TABLE casinos ADD FULLTEXT(name)");
        SQL("ALTER TABLE games ADD FULLTEXT(name)");
    }
    
    /**
     * Rolls back changes
     */
    public function down(): void
    {
        
    }
}

