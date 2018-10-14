<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\User;
use App\Book;

class ModelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_has_many_books()
    {
        $this->assertHasMany(Book::class, 'user_id', new User, 'books');
    }

    public function test_it_belongs_to_user()
    {
        $this->assertBelongsTo(User::class, 'user_id', 'id', new Book, 'user');
    }

    protected function assertHasMany($related, $foreignKey, $model, $relationName)
    {
        /** @var HasMany */
        $relation = $model->$relationName();

        $this->assertInstanceOf(HasMany::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf($related, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals($foreignKey, $relation->getForeignKeyName(), 'Foreign key is wrong');
    }

    protected function assertBelongsTo($related, $foreignKey, $ownerKey, $model, $relationName)
    {
        /** @var BelongsTo */
        $relation = $model->$relationName();

        $this->assertInstanceOf(BelongsTo::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf($related, $relation->getRelated(), 'Related model is wrong');
        $this->assertEquals($ownerKey, $relation->getOwnerKey(), 'Owner key is wrong');
        $this->assertEquals($foreignKey, $relation->getForeignKey(), 'Foreign key is wrong');
    }
}
