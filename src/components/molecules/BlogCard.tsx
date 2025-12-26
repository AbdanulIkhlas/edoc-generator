import { motion } from "framer-motion";
import { Lock, ArrowRight, Calendar } from "lucide-react";
import { Link } from "react-router-dom";
import type { BlogPost } from "@/data/blog";
import Badge from "@/components/atoms/Badge";

interface BlogCardProps {
  post: BlogPost;
  index: number;
}

const BlogCard = ({ post, index }: BlogCardProps) => {
  const formattedDate = new Date(post.date).toLocaleDateString("en-US", {
    month: "short",
    day: "numeric",
    year: "numeric",
  });

  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ delay: index * 0.1, duration: 0.5 }}
      className="group"
    >
      <Link to={`/blog/${post.id}`}>
        <div className="relative p-6 rounded-2xl bg-card border border-border hover:border-primary/30 transition-all hover:shadow-lg">
          <div className="flex items-start justify-between gap-4">
            <div className="flex-1 space-y-3">
              <div className="flex items-center gap-3 text-sm text-muted-foreground">
                <div className="flex items-center gap-1">
                  <Calendar size={14} />
                  <span>{formattedDate}</span>
                </div>
                <span className="text-border">•</span>
                <span>{post.readTime}</span>
                {post.isPrivate && (
                  <>
                    <span className="text-border">•</span>
                    <div className="flex items-center gap-1 text-primary">
                      <Lock size={14} />
                      <span>Private</span>
                    </div>
                  </>
                )}
              </div>

              <h3 className="text-xl font-heading font-semibold text-foreground group-hover:text-primary transition-colors">
                {post.title}
              </h3>

              <p className="text-muted-foreground text-sm leading-relaxed">
                {post.excerpt}
              </p>

              <div className="flex flex-wrap gap-2">
                {post.tags.map((tag) => (
                  <Badge key={tag} variant="outline">{tag}</Badge>
                ))}
              </div>
            </div>

            <motion.div
              className="flex items-center justify-center w-10 h-10 rounded-full bg-secondary group-hover:bg-primary/10 transition-colors shrink-0"
              whileHover={{ x: 4 }}
            >
              <ArrowRight size={18} className="text-muted-foreground group-hover:text-primary transition-colors" />
            </motion.div>
          </div>
        </div>
      </Link>
    </motion.div>
  );
};

export default BlogCard;
