<?php
class Version20210205105634 implements \Hlis\Migration\Script
{
    /**
     * Commits changes
     */
    public function up(): void
    {
        SQL("ALTER TABLE play_versions ADD UNIQUE(name)");
    }
    
    /**
     * Rolls back changes
     */
    public function down(): void
    {
        
    }
}

