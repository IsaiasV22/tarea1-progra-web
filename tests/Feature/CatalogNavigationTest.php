<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogNavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_index_pages_load_successfully(): void
    {
        $this->seed();

        $this->get(route('authors.index'))->assertOk();
        $this->get(route('books.index'))->assertOk();
        $this->get(route('publishers.index'))->assertOk();
    }

    public function test_book_detail_contains_links_to_author_and_publisher(): void
    {
        $this->seed();

        $response = $this->get(route('books.show', 1));

        $response->assertOk();
        $response->assertSee(route('authors.show', 1, false));
        $response->assertSee(route('publishers.show', 1, false));
    }

    public function test_author_and_publisher_details_link_to_related_books(): void
    {
        $this->seed();

        $authorResponse = $this->get(route('authors.show', 1));
        $publisherResponse = $this->get(route('publishers.show', 1));

        $authorResponse->assertOk();
        $authorResponse->assertSee(route('books.show', 1, false));

        $publisherResponse->assertOk();
        $publisherResponse->assertSee(route('books.show', 1, false));
    }

    public function test_create_and_edit_pages_load_successfully(): void
    {
        $this->seed();

        $this->get(route('books.create'))->assertOk();
        $this->get(route('books.edit', 1))->assertOk();

        $this->get(route('authors.create'))->assertOk();
        $this->get(route('authors.edit', 1))->assertOk();

        $this->get(route('publishers.create'))->assertOk();
        $this->get(route('publishers.edit', 1))->assertOk();
    }

    public function test_book_can_be_created_and_updated(): void
    {
        $this->seed();

        $createResponse = $this->post(route('books.store'), [
            'title' => 'New Catalog Book',
            'edition' => '1st',
            'copyright' => 2024,
            'language' => 'English',
            'pages' => 350,
            'author_id' => 1,
            'publisher_id' => 1,
        ]);

        $bookId = (int) \App\Models\Book::query()
            ->where('title', 'New Catalog Book')
            ->value('id');

        $createResponse->assertRedirect(route('books.show', $bookId));
        $this->assertDatabaseHas('books', ['title' => 'New Catalog Book']);

        $updateResponse = $this->put(route('books.update', $bookId), [
            'title' => 'Updated Catalog Book',
            'edition' => '2nd',
            'copyright' => 2025,
            'language' => 'English',
            'pages' => 410,
            'author_id' => 1,
            'publisher_id' => 1,
        ]);

        $updateResponse->assertRedirect(route('books.show', $bookId));
        $this->assertDatabaseHas('books', ['id' => $bookId, 'title' => 'Updated Catalog Book']);
    }

    public function test_author_and_publisher_can_be_created_and_updated(): void
    {
        $this->seed();

        $authorCreateResponse = $this->post(route('authors.store'), [
            'name' => 'Test Author',
            'nationality' => 'Costa Rican',
            'birth_year' => 1990,
            'fields' => 'Databases',
        ]);

        $authorId = (int) \App\Models\Author::query()
            ->where('name', 'Test Author')
            ->value('id');

        $authorCreateResponse->assertRedirect(route('authors.show', $authorId));

        $authorUpdateResponse = $this->put(route('authors.update', $authorId), [
            'name' => 'Updated Author',
            'nationality' => 'Costa Rican',
            'birth_year' => 1991,
            'fields' => 'Databases, Backend',
        ]);

        $authorUpdateResponse->assertRedirect(route('authors.show', $authorId));
        $this->assertDatabaseHas('authors', ['id' => $authorId, 'name' => 'Updated Author']);

        $publisherCreateResponse = $this->post(route('publishers.store'), [
            'name' => 'Test Publisher',
            'country' => 'Costa Rica',
            'founded' => 2010,
            'genre' => 'Technology',
        ]);

        $publisherId = (int) \App\Models\Publisher::query()
            ->where('name', 'Test Publisher')
            ->value('id');

        $publisherCreateResponse->assertRedirect(route('publishers.show', $publisherId));

        $publisherUpdateResponse = $this->put(route('publishers.update', $publisherId), [
            'name' => 'Updated Publisher',
            'country' => 'Costa Rica',
            'founded' => 2011,
            'genre' => 'Computer Science',
        ]);

        $publisherUpdateResponse->assertRedirect(route('publishers.show', $publisherId));
        $this->assertDatabaseHas('publishers', ['id' => $publisherId, 'name' => 'Updated Publisher']);
    }
}
