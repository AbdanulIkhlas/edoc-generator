import SectionHeading from "@/components/atoms/SectionHeading";
import BlogCard from "@/components/molecules/BlogCard";
import { blogPosts, blogContent } from "@/data/blog";

const BlogSection = () => {
  return (
    <section className="py-24 bg-background">
      <div className="container mx-auto px-6">
        <SectionHeading
          title={blogContent.heading}
          subtitle={blogContent.subheading}
        />

        <div className="space-y-6">
          {blogPosts.map((post, index) => (
            <BlogCard key={post.id} post={post} index={index} />
          ))}
        </div>
      </div>
    </section>
  );
};

export default BlogSection;
