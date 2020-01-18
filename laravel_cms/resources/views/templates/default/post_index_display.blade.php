<h2>Posts:</h2>


<a href="{{ url($page->page_path.'/create') }}">Create new...</a>


            <ul>
                    @forelse($blogs as $blog)
                            <li>
                                    @includeIf("templates." . "default"  . ".title_display")
                                    <br>
                                    <a href ="{{ route('blog.show', [ 'blog' => $blog, 'user' => $page->user->page_name, 'path' => $page->page_name /*TODO is 'one' useless?*/]) }}"><strong>show</strong></a>
                                    <div>
                                            @if($galleries=\App\Gallery::where('blog_id', $blog->id)->first())
                                                    @includeIf("templates." . "default"  . ".image_display")
                                                @endif
                                            <p>
                                                    @markdown($blog>contents)
                                                </p>
                                        </div>
                                </li>
                        @empty
                            <p>No posts.</p>
                        @endforelse
                </ul>
