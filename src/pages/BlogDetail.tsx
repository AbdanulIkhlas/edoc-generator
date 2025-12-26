import { useState } from "react";
import { useParams, Link } from "react-router-dom";
import { motion } from "framer-motion";
import { ArrowLeft, Calendar, Clock, Lock, MessageCircle } from "lucide-react";
import MainLayout from "@/layouts/MainLayout";
import Badge from "@/components/atoms/Badge";
import { blogPosts, blogContent, whitelist } from "@/data/blog";
import { useToast } from "@/hooks/use-toast";

const BlogDetail = () => {
  const { slug } = useParams();
  const post = blogPosts.find((p) => p.id === slug);
  const [email, setEmail] = useState("");
  const [hasAccess, setHasAccess] = useState(false);
  const { toast } = useToast();

  if (!post) {
    return (
      <MainLayout>
        <div className="py-24 text-center">
          <h1 className="text-2xl font-heading font-bold text-foreground mb-4">
            Post not found
          </h1>
          <Link to="/blog" className="text-primary">
            ← Back to blog
          </Link>
        </div>
      </MainLayout>
    );
  }

  const formattedDate = new Date(post.date).toLocaleDateString("en-US", {
    month: "long",
    day: "numeric",
    year: "numeric",
  });

  const checkAccess = () => {
    if (whitelist.includes(email.toLowerCase().trim())) {
      setHasAccess(true);
      toast({
        title: "Access granted!",
        description: "You can now read the full post.",
      });
    } else {
      // Redirect to WhatsApp
      const message = encodeURIComponent(
        `Hi! I'd like to request access to the private blog post: "${post.title}". My email is: ${email}`
      );
      window.open(`https://wa.me/?text=${message}`, "_blank");
      toast({
        title: "Request sent",
        description: "Please wait for approval.",
      });
    }
  };

  // Sample content for non-private posts
  const sampleContent = `
    This is a sample blog post content. In a real implementation, this would be loaded from MDX files or a CMS.
    
    ## Introduction
    
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
    
    ## Key Takeaways
    
    - Point one about the topic
    - Another important consideration
    - Final thoughts and recommendations
    
    Thank you for reading!
  `;

  return (
    <MainLayout>
      <article className="py-24 bg-background">
        <div className="container mx-auto px-6">
          <div className="max-w-3xl mx-auto">
            {/* Back link */}
            <motion.div
              initial={{ opacity: 0, x: -20 }}
              animate={{ opacity: 1, x: 0 }}
              className="mb-8"
            >
              <Link
                to="/blog"
                className="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors"
              >
                <ArrowLeft size={18} />
                Back to blog
              </Link>
            </motion.div>

            {/* Header */}
            <motion.header
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              className="mb-12"
            >
              <div className="flex flex-wrap items-center gap-3 text-sm text-muted-foreground mb-4">
                <div className="flex items-center gap-1">
                  <Calendar size={14} />
                  <span>{formattedDate}</span>
                </div>
                <span className="text-border">•</span>
                <div className="flex items-center gap-1">
                  <Clock size={14} />
                  <span>{post.readTime}</span>
                </div>
                {post.isPrivate && (
                  <>
                    <span className="text-border">•</span>
                    <div className="flex items-center gap-1 text-primary">
                      <Lock size={14} />
                      <span>{blogContent.privateLabel}</span>
                    </div>
                  </>
                )}
              </div>

              <h1 className="text-3xl md:text-4xl font-heading font-bold text-foreground mb-4">
                {post.title}
              </h1>

              <div className="flex flex-wrap gap-2">
                {post.tags.map((tag) => (
                  <Badge key={tag} variant="outline">{tag}</Badge>
                ))}
              </div>
            </motion.header>

            {/* Content or Access Gate */}
            {post.isPrivate && !hasAccess ? (
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.1 }}
                className="p-8 rounded-2xl bg-card border border-border text-center"
              >
                <Lock className="w-12 h-12 text-primary mx-auto mb-4" />
                <h2 className="text-xl font-heading font-semibold text-foreground mb-2">
                  This post is private
                </h2>
                <p className="text-muted-foreground mb-6">
                  Enter your email to check access or request it.
                </p>

                <div className="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                  <input
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    placeholder="your@email.com"
                    className="flex-1 px-4 py-3 rounded-xl bg-background border border-border text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50"
                  />
                  <motion.button
                    onClick={checkAccess}
                    className="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-medium rounded-xl"
                    whileHover={{ scale: 1.02 }}
                    whileTap={{ scale: 0.98 }}
                  >
                    <MessageCircle size={18} />
                    {blogContent.requestAccessLabel}
                  </motion.button>
                </div>
              </motion.div>
            ) : (
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.1 }}
                className="prose prose-lg prose-invert max-w-none"
              >
                <div className="text-muted-foreground leading-relaxed space-y-4">
                  <p className="text-lg">{post.excerpt}</p>
                  <div className="whitespace-pre-line">{sampleContent}</div>
                </div>
              </motion.div>
            )}
          </div>
        </div>
      </article>
    </MainLayout>
  );
};

export default BlogDetail;
