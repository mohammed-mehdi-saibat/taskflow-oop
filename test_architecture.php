<?php
require_once 'vendor/autoload.php';

use App\Core\Database;
use App\Entities\{Developer, Manager, FeatureTask, BugTask, TeamMember, Task};

echo "=== TASKFLOW PART 1: ARCHITECTURE VALIDATION ===\n\n";

// Test 1: Singleton Database
echo "1. Testing Singleton Database:\n";
try {
    $db1 = Database::getInstance();
    $db2 = Database::getInstance();

    if ($db1 === $db2) {
        echo "   PASS: Singleton works correctly (same instance)\n";
    } else {
        echo "FAIL: Singleton pattern broken (different instances)\n";
    }
} catch (Exception $e) {
    echo " FAIL: " . $e->getMessage() . "\n";
}

// Test 2: Inheritance Hierarchy
echo "\n2. Testing Inheritance Hierarchy:\n";
try {
    $developer = new Developer(1, "john_dev", "john@company.com", "password123", "developer", 1);
    $manager = new Manager(2, "jane_manager", "jane@company.com", "password123", "manager", 1);

    // Check inheritance
    if ($developer instanceof \App\Entities\TeamMember) {
        echo " PASS: Developer extends TeamMember\n";
    }

    if ($manager instanceof \App\Entities\TeamMember) {
        echo " PASS: Manager extends TeamMember\n";
    }

    // Check abstract methods
    echo "   Developer can create project: " . ($developer->canCreateProject() ? 'Yes' : 'No') . " (expected: No)\n";
    echo "   Manager can create project: " . ($manager->canCreateProject() ? 'Yes' : 'No') . " (expected: Yes)\n";
} catch (Exception $e) {
    echo "  FAIL: " . $e->getMessage() . "\n";
}

// Test 3: Task Hierarchy
echo "\n3. Testing Task Hierarchy:\n";
try {
    $featureTask = new FeatureTask(101, "New Login Feature", "Implement 0Auth login");
    $bugTask = new BugTask(102, "Fix php bug", "Button alignment issue");

    $featureTask->setPriority('heigh');
    $bugTask->setPriority('critical');

    if ($featureTask instanceof Task) {
        echo "  PASS: FeatureTask extends Task\n";
    }

    if ($bugTask instanceof Task) {
        echo "  PASS: BugTask extends Task\n";
    }

    // Check interface implementation
    if ($featureTask instanceof \App\Interfaces\Assignable) {
        echo "  PASS: FeatureTask implements Assignable\n";
    }

    if ($bugTask instanceof \App\Interfaces\Prioritizable) {
        echo "  PASS: BugTask implements Prioritizable\n";
    }

    // Check Complexity Calculation
    echo " Feature Complexity (High): " . $featureTask->calculateComplexity() . "\n";
    echo " Bug Complexity (Critical): " . $bugTask->calculateComplexity() . "\n";
} catch (Exception $e) {
    echo "   FAIL: " . $e->getMessage() . "\n";
}

// Test 4: Abstract Class Prevention
echo "\n4. Testing Abstract Class Instantiation Prevention:\n";
try {
    // This should fail
    $reflection = new ReflectionClass(Task::class);
    if ($reflection->isAbstract()) {
        echo "   ✅ PASS: Task class is Abstract and cannot be instantiated directly.\n";
    } else {
        echo "   ❌ FAIL: Task class is NOT Abstract.\n";
    }
} catch (Error $e) {
    echo "   ✅ PASS: Cannot instantiate abstract Task class\n";
}

echo "\n=== VALIDATION COMPLETE ===\n";
echo "If all tests pass, you're ready for Part 2!\n";
